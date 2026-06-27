<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('forum.index', $class->id) }}"
               class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Forum {{ $class->name }}
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Thread Utama --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 w-11 h-11 rounded-full flex items-center justify-center font-bold text-sm uppercase
                            {{ $discussion->user->role === 'guru' ? 'bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400' : 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400' }}">
                            {{ substr($discussion->user->name, 0, 2) }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 flex-wrap mb-2">
                                @if ($discussion->is_pinned)
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">📌 Disematkan</span>
                                @endif
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold
                                    {{ $discussion->user->role === 'guru' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600' : 'bg-gray-100 dark:bg-gray-700 text-gray-500' }}">
                                    {{ ucfirst($discussion->user->role) }}
                                </span>
                            </div>
                            <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100 leading-tight">{{ $discussion->title }}</h1>
                            <p class="text-xs text-gray-400 mt-1">
                                oleh <span class="font-semibold text-gray-600 dark:text-gray-300">{{ $discussion->user->name }}</span>
                                · {{ $discussion->created_at->format('d M Y, H:i') }}
                            </p>
                            <div class="mt-4 prose prose-sm dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $discussion->body }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar Balasan --}}
            @if ($discussion->replies->count() > 0)
                <div class="space-y-3">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider px-1">
                        {{ $discussion->replies->count() }} Balasan
                    </h3>
                    @foreach ($discussion->replies as $reply)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                            <div class="flex items-start gap-3">
                                <div class="shrink-0 w-9 h-9 rounded-full flex items-center justify-center font-bold text-xs uppercase
                                    {{ $reply->user->role === 'guru' ? 'bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400' : 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400' }}">
                                    {{ substr($reply->user->name, 0, 2) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-sm text-gray-900 dark:text-gray-100">{{ $reply->user->name }}</span>
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold
                                                {{ $reply->user->role === 'guru' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600' : 'bg-gray-100 dark:bg-gray-700 text-gray-500' }}">
                                                {{ ucfirst($reply->user->role) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            @if (auth()->user()->role === 'guru' || $reply->user_id === auth()->id())
                                                <form action="{{ route('forum.reply.destroy', [$class->id, $discussion->id, $reply->id]) }}" method="POST"
                                                      onsubmit="return confirm('Hapus balasan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-gray-300 dark:text-gray-600 hover:text-rose-500 dark:hover:text-rose-400 transition-colors">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $reply->body }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Form Balas --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="font-bold text-gray-900 dark:text-gray-100 mb-4">Tulis Balasan</h3>
                <form action="{{ route('forum.reply.store', [$class->id, $discussion->id]) }}" method="POST" class="space-y-4">
                    @csrf
                    @error('body')
                        <p class="text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                    <div>
                        <textarea name="body" rows="4" required
                            placeholder="Tulis balasan Anda di sini..."
                            class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none resize-none transition-all">{{ old('body') }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 hover:opacity-90 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
