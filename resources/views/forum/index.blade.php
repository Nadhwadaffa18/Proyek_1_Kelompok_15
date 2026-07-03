<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                    🗨️ Forum Diskusi — {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5 font-mono">Diskusikan materi dan tanyakan pertanyaan di sini</p>
            </div>
            <a href="{{ route('forum.create', $class->id) }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                <svg class="w-4.5 h-4.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Topik Baru
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @forelse ($discussions as $discussion)
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-5 flex items-start gap-4 hover:shadow-soft-lg transition-all duration-300">
                {{-- Avatar --}}
                <div class="shrink-0 w-10 h-10 rounded-lg flex items-center justify-center font-bold text-sm border uppercase
                    {{ $discussion->user->role === 'guru' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-500/15' : 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/15' }}">
                    {{ substr($discussion->user->name, 0, 2) }}
                </div>

                {{-- Content --}}
                <div class="flex-grow min-w-0">
                    <div class="flex items-center gap-2 flex-wrap mb-2">
                        @if ($discussion->is_pinned)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold font-mono uppercase bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/10">
                                📌 PINNED
                            </span>
                        @endif
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold font-mono uppercase
                            {{ $discussion->user->role === 'guru' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10' : 'bg-slate-500/10 text-slate-500 dark:text-slate-400 border border-slate-500/10' }}">
                            {{ $discussion->user->role }}
                        </span>
                    </div>

                    <a href="{{ route('forum.show', [$class->id, $discussion->id]) }}"
                       class="font-bold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base leading-snug block tracking-tight">
                        {{ $discussion->title }}
                    </a>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1.5 line-clamp-1 leading-relaxed">{{ $discussion->body }}</p>

                    <div class="flex items-center gap-3 mt-3 text-xs text-slate-400 dark:text-slate-500 font-mono">
                        <span class="font-sans font-semibold text-slate-600 dark:text-slate-300">{{ $discussion->user->name }}</span>
                        <span>·</span>
                        <span>{{ $discussion->created_at->diffForHumans() }}</span>
                        <span>·</span>
                        <span class="inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
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
                                class="text-slate-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors p-1.5 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg">
                                <svg class="w-4.5 h-4.5" fill="{{ $discussion->is_pinned ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            </button>
                        </form>
                    @endif

                    @if (auth()->user()->role === 'guru' || $discussion->user_id === auth()->id())
                        <form action="{{ route('forum.destroy', [$class->id, $discussion->id]) }}" method="POST"
                              onsubmit="return confirm('Hapus topik ini beserta semua balasannya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 transition-colors p-1.5 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 p-16 text-center shadow-soft">
                <div class="w-16 h-16 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/15 flex items-center justify-center mx-auto mb-5 text-2xl">
                    💬
                </div>
                <h3 class="font-bold text-slate-850 dark:text-white text-lg">Belum ada diskusi</h3>
                <p class="text-slate-400 dark:text-slate-500 text-xs mt-1 max-w-sm mx-auto leading-relaxed">Jadilah yang pertama memulai topik diskusi baru untuk kelas ini!</p>
                <a href="{{ route('forum.create', $class->id) }}"
                   class="inline-flex items-center mt-5 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-xl transition-all shadow-sm">
                    Buat Topik Pertama
                </a>
            </div>
        @endforelse
    </div>
</x-app-layout>
