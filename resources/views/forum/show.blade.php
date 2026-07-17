<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full gap-4">
            <a href="{{ route('forum.index', $class->id) }}" class="inline-flex items-center text-sm font-bold text-slate-900">
                <i class="fa-solid fa-arrow-left mr-1.5"></i>
                Kembali ke Forum
            </a>
            <span class="text-sm font-bold text-slate-900 uppercase tracking-wider gap-4">{{ $class->name }}</span>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Thread Utama --}}
        <div class="bg-white rounded-card border border-white/45 shadow-soft overflow-hidden hover:shadow-soft-lg transition-all duration-300">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-11 h-11 rounded-lg flex items-center justify-center font-bold text-sm border uppercase
                        {{ $discussion->user->role === 'guru' ? 'bg-primary/10 text-primary border-primary/15' : 'bg-emerald-500/10 text-emerald-600 border-emerald-500/15' }}">
                        {{ substr($discussion->user->name, 0, 2) }}
                    </div>
                    <div class="flex-grow min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-2">
                            @if ($discussion->is_pinned)
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-amber-500/10 text-amber-600 border border-amber-500/10"><i class="fa-solid fa-thumbtack text-[8px] mr-1"></i> PINNED</span>
                            @endif
                            <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase
                                {{ $discussion->user->role === 'guru' ? 'bg-primary/10 text-primary border border-primary/10' : 'bg-slate-500/10 text-slate-500 border border-slate-500/10' }}">
                                {{ $discussion->user->role }}
                            </span>
                        </div>
                        <h1 class="text-xl font-bold text-slate-900 leading-snug tracking-tight font-display">{{ $discussion->title }}</h1>
                        <p class="text-xs text-slate-450 mt-1.5 font-semibold uppercase tracking-wider">
                            oleh <span class="font-sans text-slate-600">{{ $discussion->user->name }}</span>
                            · {{ $discussion->created_at->format('d M Y, H:i') }}
                        </p>
                        <div class="mt-5 prose prose-sm max-w-none text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $discussion->body }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Balasan --}}
        @if ($discussion->replies->count() > 0)
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider px-1 font-mono">
                    {{ $discussion->replies->count() }} Balasan
                </h3>
                @foreach ($discussion->replies as $reply)
                    <div class="bg-white rounded-card border border-white/45 shadow-soft p-5 hover:shadow-soft-lg transition-all duration-300">
                        <div class="flex items-start gap-3">
                            <div class="shrink-0 w-9 h-9 rounded-lg flex items-center justify-center font-bold text-xs border uppercase
                                {{ $reply->user->role === 'guru' ? 'bg-primary/10 text-primary border-primary/15' : 'bg-emerald-500/10 text-emerald-600 border-emerald-500/15' }}">
                                {{ substr($reply->user->name, 0, 2) }}
                            </div>
                            <div class="flex-grow min-w-0">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-sm text-slate-900 font-display">{{ $reply->user->name }}</span>
                                        <span class="px-2 py-0.5 rounded-full text-[8px] font-bold uppercase
                                            {{ $reply->user->role === 'guru' ? 'bg-primary/10 text-primary border border-primary/10' : 'bg-slate-500/10 text-slate-500 border border-slate-500/10' }}">
                                            {{ $reply->user->role }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2.5 shrink-0">
                                        <span class="text-[10px] text-slate-400 font-mono">{{ $reply->created_at->diffForHumans() }}</span>
                                        @if (auth()->user()->role === 'guru' || $reply->user_id === auth()->id())
                                            <form action="{{ route('forum.reply.destroy', [$class->id, $discussion->id, $reply->id]) }}" method="POST"
                                                  onsubmit="return confirm('Hapus balasan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-350 hover:text-danger transition-colors p-1  rounded">
                                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $reply->body }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Form Balas --}}
        <div class="bg-white rounded-card border border-white/45 shadow-soft p-6">
            <h3 class="font-bold text-slate-900 mb-4 font-display">Tulis Balasan</h3>
            <form action="{{ route('forum.reply.store', [$class->id, $discussion->id]) }}" method="POST" class="space-y-4">
                @csrf
                @error('body')
                    <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                @enderror
                <div>
                    <textarea name="body" rows="4" required
                        placeholder="Tulis balasan Anda di sini..."
                        class="block w-full bg-white text-slate-900 border border-slate-200 focus:border-primary focus:ring-1 focus:ring-primary rounded-[12px] shadow-sm py-3.5 px-4 transition-all text-sm outline-none resize-none" style="resize: none;">{{ old('body') }}</textarea>
                </div>
                <div class="flex justify-end pt-2">
                    <x-primary-button>
                        <i class="fa-solid fa-paper-plane mr-1.5 text-xs"></i>
                        Kirim Balasan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
