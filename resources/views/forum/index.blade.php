<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full gap-4">
            <div>
                <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                    <span class="text-white p-2">
                        <i class="fa-solid fa-comments"></i>
                    </span>
                    Forum Diskusi — {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold text-slate-900 uppercase tracking-wider mt-1.5">Diskusikan materi dan tanyakan pertanyaan di sini</p>
            </div>
            <a href="{{ route('forum.create', $class->id) }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-primary to-secondary text-white text-sm font-semibold rounded-[14px] shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                <i class="fa-solid fa-plus mr-1.5"></i>
                Topik Baru
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @forelse ($discussions as $discussion)
            <div class="bg-white rounded-card border border-white/45 shadow-soft p-5 flex items-start gap-4 hover:shadow-soft-lg hover:scale-[1.01] transition-all duration-300">
                {{-- Avatar --}}
                <div class="shrink-0 w-10 h-10 rounded-lg flex items-center justify-center font-bold text-sm border uppercase
                    {{ $discussion->user->role === 'guru' ? 'bg-primary/10 text-primary border-primary/15' : 'bg-emerald-500/10 text-emerald-600 border-emerald-500/15' }}">
                    {{ substr($discussion->user->name, 0, 2) }}
                </div>

                {{-- Content --}}
                <div class="flex-grow min-w-0">
                    <div class="flex items-center gap-2 flex-wrap mb-2">
                        @if ($discussion->is_pinned)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-amber-500/10 text-amber-600 border border-amber-500/10">
                                <i class="fa-solid fa-thumbtack text-[8px] rotate-45"></i> PINNED
                            </span>
                        @endif
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase
                            {{ $discussion->user->role === 'guru' ? 'bg-primary/10 text-primary border border-primary/10' : 'bg-slate-500/10 text-slate-500 border border-slate-500/10' }}">
                            {{ $discussion->user->role }}
                        </span>
                    </div>

                    <a href="{{ route('forum.show', [$class->id, $discussion->id]) }}"
                       class="font-display font-bold text-slate-900 hover:text-primary transition-colors text-base leading-snug block tracking-tight">
                        {{ $discussion->title }}
                    </a>
                    <p class="text-sm text-slate-500 mt-1.5 line-clamp-1 leading-relaxed">{{ $discussion->body }}</p>

                    <div class="flex items-center gap-3 mt-3 text-xs text-slate-450 font-semibold uppercase tracking-wider">
                        <span class="font-sans text-slate-600">{{ $discussion->user->name }}</span>
                        <span>·</span>
                        <span>{{ $discussion->created_at->diffForHumans() }}</span>
                        <span>·</span>
                        <span class="inline-flex items-center gap-1.5 text-slate-550">
                            <i class="fa-regular fa-comment text-slate-400"></i>
                            {{ $discussion->replies->count() }} balasan
                        </span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="shrink-0 flex items-center gap-2">
                    @if (auth()->user()->role === 'guru')
                        <form action="{{ route('forum.pin', [$class->id, $discussion->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" title="{{ $discussion->is_pinned ? 'Unpin' : 'Pin' }}"
                                class="text-slate-400 hover:text-amber-500 transition-colors p-1.5 hover:bg-slate-50 rounded-lg">
                                <i class="{{ $discussion->is_pinned ? 'fa-solid' : 'fa-regular' }} fa-solid fa-thumbtack rotate-45 text-base"></i>
                            </button>
                        </form>
                    @endif

                    @if (auth()->user()->role === 'guru' || $discussion->user_id === auth()->id())
                        <form action="{{ route('forum.destroy', [$class->id, $discussion->id]) }}" method="POST"
                               onsubmit="return confirm('Hapus topik ini beserta semua balasannya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 hover:text-danger transition-colors p-1.5 hover:bg-slate-50 rounded-lg">
                                <i class="fa-solid fa-trash-can text-base"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 p-16 text-center shadow-soft">
                <div class="w-16 h-16 rounded-xl bg-primary/10 text-primary border border-primary/15 flex items-center justify-center mx-auto mb-5 text-2xl">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg font-display">Belum ada diskusi</h3>
                <p class="text-slate-400 text-xs mt-1 max-w-sm mx-auto leading-relaxed">Jadilah yang pertama memulai topik diskusi baru untuk kelas ini!</p>
                <a href="{{ route('forum.create', $class->id) }}"
                   class="inline-flex items-center mt-5 px-5 py-2.5 bg-gradient-to-r from-primary to-secondary text-white text-xs font-semibold rounded-[14px] shadow-sm hover:scale-[1.02] transition-all">
                    Buat Topik Pertama
                </a>
            </div>
        @endforelse
    </div>
</x-app-layout>
