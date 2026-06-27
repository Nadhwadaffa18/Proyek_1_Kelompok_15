<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            ➕ Topik Diskusi Baru — {{ $class->name }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('forum.store', $class->id) }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Judul Topik</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                                placeholder="Contoh: Apa perbedaan antara A dan B?"
                                class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                            @error('title')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="body" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Isi Diskusi</label>
                            <textarea id="body" name="body" rows="6" required
                                placeholder="Jelaskan pertanyaan atau topik yang ingin Anda diskusikan..."
                                class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none resize-none transition-all">{{ old('body') }}</textarea>
                            @error('body')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('forum.index', $class->id) }}"
                               class="text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 hover:opacity-90 transition-all">
                                Buat Topik
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
