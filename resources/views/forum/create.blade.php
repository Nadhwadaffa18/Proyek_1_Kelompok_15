<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                ➕ Topik Diskusi Baru — {{ $class->name }}
            </h2>
            <a href="{{ route('forum.index', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-[18px] border border-slate-200/80  shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('forum.store', $class->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-500 font-mono mb-1.5">Judul Topik</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                            placeholder="Contoh: Apa perbedaan antara A dan B?"
                            class="block w-full bg-white text-slate-900 border border-slate-200  focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm outline-none">
                        @error('title')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="body" class="block text-xs font-bold uppercase tracking-wider text-slate-500 font-mono mb-1.5">Isi Diskusi</label>
                        <textarea id="body" name="body" rows="6" required
                            placeholder="Jelaskan pertanyaan atau topik yang ingin Anda diskusikan..."
                            class="block w-full bg-white text-slate-900 border border-slate-200 focus:border-indigo-500  focus:ring-1 focus:ring-indigo-500 rounded-[12px] shadow-sm py-3.5 px-3.5 transition-all text-sm outline-none resize-none" style="resize: none;">{{ old('body') }}</textarea>
                        @error('body')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100">
                        <a href="{{ route('forum.index', $class->id) }}"
                           class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Buat Topik
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
