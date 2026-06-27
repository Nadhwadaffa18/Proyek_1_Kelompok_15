<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    🗨️ Forum Diskusi — {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Diskusikan materi dan tanyakan pertanyaan di sini</p>
            </div>
            <a href="{{ route('forum.create', $class->id) }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 hover:opacity-90 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Topik Baru
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($discussions as $discussion)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 flex items-start gap-4 hover:shadow-md transition-shadow">

                    {{-- Avatar --}}
                    <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm uppercase
                        {{ $discussion->user->role === 'guru' ? 'bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400' : 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400' }}">
                        {{ substr($discussion->user->name, 0, 2) }}
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            @if ($discussion->is_pinned)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">
                                    📌 Disematkan
                                </span>
                            @endif
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold
                                {{ $discussion->user->role === 'guru' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400' }}">
                                {{ ucfirst($discussion->user->role) }}
                            </span>
                        </div>

                        <a href="{{ route('forum.show', [$class->id, $discussion->id]) }}"
                           class="font-semibold text-gray-900 dark:text-gray-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-base leading-tight block">
                            {{ $discussion->title }}
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-1">{{ $discussion->body }}</p>

                        <div class="flex items-center gap-3 mt-2 text-xs text-gray-400 dark:text-gray-500">
                            <span>{{ $discussion->user->name }}</span>
                            <span>·</span>
                            <span>{{ $discussion->created_at->diffForHumans() }}</span>
                            <span>·</span>
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    class="text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="{{ $discussion->is_pinned ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
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
                                <button type="submit" class="text-gray-400 hover:text-rose-500 dark:hover:text-rose-400 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-12 text-center">
                    <div class="text-5xl mb-4">💬</div>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-lg">Belum ada diskusi</h3>
                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Jadilah yang pertama memulai topik diskusi!</p>
                    <a href="{{ route('forum.create', $class->id) }}"
                       class="inline-flex items-center mt-4 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition-colors">
                        Buat Topik Pertama
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
