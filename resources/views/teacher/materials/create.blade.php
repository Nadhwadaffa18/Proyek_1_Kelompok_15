<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Unggah Materi Pembelajaran Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white rounded-[18px] border border-slate-200/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Pilih Kelas -->
                    <div>
                        <x-input-label for="class_id" :value="__('Pilih Kelas')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                        <select id="class_id" name="class_id" class="block mt-1.5 w-full bg-white text-slate-900 border border-slate-200 focus:border-primary focus:ring-1 focus:ring-primary rounded-[12px] shadow-sm py-3 px-4 transition-all text-sm outline-none" required>
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
                        <x-input-label for="title" :value="__('Judul Materi')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                        <x-text-input id="title" class="block mt-1.5 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Bab I - Pengenalan Aksara" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Materi')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                        <textarea id="description" name="description" rows="4" class="block mt-1.5 w-full bg-white text-slate-900 border border-slate-200 focus:border-primary focus:ring-1 focus:ring-primary rounded-[12px] shadow-sm py-3 px-4 transition-all text-sm placeholder-slate-400 outline-none resize-none" placeholder="Tuliskan rangkuman singkat atau deskripsi materi di sini...">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Upload File -->
                    <div>
                        <x-input-label for="file" :value="__('Unggah Berkas Materi')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                        <input id="file" name="file" type="file" class="block mt-1.5 w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-[12px] file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary hover:file:text-white transition-colors duration-150 cursor-pointer" />
                        <p class="text-[10px] text-slate-400 mt-2 font-mono">Format: PDF, Word, PPT, Excel, Video (Max 20MB)</p>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100">
                        <a href="{{ route('teacher.materials.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
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
