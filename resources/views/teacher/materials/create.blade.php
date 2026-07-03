<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Unggah Materi Pembelajaran Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Pilih Kelas -->
                    <div>
                        <x-input-label for="class_id" :value="__('Pilih Kelas')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <select id="class_id" name="class_id" class="block mt-1.5 w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('class_id')" class="mt-2" />
                    </div>

                    <!-- Judul Materi -->
                    <div>
                        <x-input-label for="title" :value="__('Judul Materi')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="title" class="block mt-1.5 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Bab I - Pengenalan Aksara" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Materi')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <textarea id="description" name="description" rows="4" class="block mt-1.5 w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3.5 transition-all text-sm placeholder-slate-400 dark:placeholder-slate-500 outline-none" placeholder="Tuliskan rangkuman singkat atau deskripsi materi di sini...">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Upload File -->
                    <div>
                        <x-input-label for="file" :value="__('Unggah Berkas Materi')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <input id="file" name="file" type="file" class="block mt-1.5 w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-[12px] file:border-0 file:text-xs file:font-bold file:bg-indigo-500/10 file:text-indigo-600 dark:file:bg-indigo-500/15 dark:file:text-indigo-400 hover:file:bg-indigo-600 hover:file:text-white transition-colors duration-150 cursor-pointer" />
                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-2 font-mono">Format: PDF, Word, PPT, Excel, Video (Max 20MB)</p>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <a href="{{ route('teacher.materials.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Unggah Materi
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
