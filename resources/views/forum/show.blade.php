<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <a href="{{ route('forum.index', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Forum
            </a>
            <span class="text-xs font-mono font-bold text-slate-400 dark:text-slate-500 uppercase">{{ $class->name }}</span>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Thread Utama --}}
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden hover:shadow-soft-lg transition-all duration-300">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-11 h-11 rounded-lg flex items-center justify-center font-bold text-sm border uppercase
                        {{ $discussion->user->role === 'guru' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-500/15' : 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/15' }}">
                        {{ substr($discussion->user->name, 0, 2) }}
                    </div>
                    <div class="flex-grow min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-2">
                            @if ($discussion->is_pinned)
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold font-mono bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/10">📌 PINNED</span>
                            @endif
                            <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold font-mono uppercase
                                {{ $discussion->user->role === 'guru' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10' : 'bg-slate-500/10 text-slate-500 dark:text-slate-400 border border-slate-500/10' }}">
                                {{ $discussion->user->role }}
                            </span>
                        </div>
                        <h1 class="text-xl font-bold text-slate-900 dark:text-white leading-snug tracking-tight">{{ $discussion->title }}</h1>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1.5 font-mono">
                            oleh <span class="font-sans font-semibold text-slate-600 dark:text-slate-300">{{ $discussion->user->name }}</span>
                            · {{ $discussion->created_at->format('d M Y, H:i') }}
                        </p>
                        <div class="mt-5 prose prose-sm dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $discussion->body }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Balasan --}}
        @if ($discussion->replies->count() > 0)
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider px-1 font-mono">
                    {{ $discussion->replies->count() }} Balasan
                </h3>
                @foreach ($discussion->replies as $reply)
                    <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-5 hover:shadow-soft-lg transition-all duration-300">
                        <div class="flex items-start gap-3">
                            <div class="shrink-0 w-9 h-9 rounded-lg flex items-center justify-center font-bold text-xs border uppercase
                                {{ $reply->user->role === 'guru' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-500/15' : 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/15' }}">
                                {{ substr($reply->user->name, 0, 2) }}
                            </div>
                            <div class="flex-grow min-w-0">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-sm text-slate-900 dark:text-white">{{ $reply->user->name }}</span>
                                        <span class="px-2 py-0.5 rounded-full text-[8px] font-bold font-mono uppercase
                                            {{ $reply->user->role === 'guru' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10' : 'bg-slate-500/10 text-slate-500 dark:text-slate-400 border border-slate-500/10' }}">
                                            {{ $reply->user->role }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2.5 shrink-0">
                                        <span class="text-[10px] text-slate-400 dark:text-slate-500 font-mono">{{ $reply->created_at->diffForHumans() }}</span>
                                        @if (auth()->user()->role === 'guru' || $reply->user_id === auth()->id())
                                            <form action="{{ route('forum.reply.destroy', [$class->id, $discussion->id, $reply->id]) }}" method="POST"
                                                  onsubmit="return confirm('Hapus balasan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-300 dark:text-slate-600 hover:text-rose-600 dark:hover:text-rose-400 transition-colors p-1 hover:bg-slate-50 dark:hover:bg-slate-800 rounded">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $reply->body }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Form Balas --}}
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6">
            <h3 class="font-bold text-slate-900 dark:text-white mb-4">Tulis Balasan</h3>
            <form action="{{ route('forum.reply.store', [$class->id, $discussion->id]) }}" method="POST" class="space-y-4">
                @csrf
                @error('body')
                    <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                @enderror
                <div>
                    <textarea name="body" rows="4" required
                        placeholder="Tulis balasan Anda di sini..."
                        class="block w-full bg-white dark:bg-slate-955 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-3.5 px-3.5 transition-all text-sm outline-none resize-none" style="resize: none;">{{ old('body') }}</textarea>
                </div>
                <div class="flex justify-end pt-2">
                    <x-primary-button>
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim Balasan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
