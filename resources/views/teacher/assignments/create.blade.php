<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Buat Tugas Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('teacher.assignments.store') }}" method="POST" class="space-y-6">
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

                    <!-- Judul Tugas -->
                    <div>
                        <x-input-label for="title" :value="__('Judul Tugas')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="title" class="block mt-1.5 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Latihan Soal Algoritma Pemrograman" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Deskripsi / Instruksi -->
                    <div>
                        <x-input-label for="description" :value="__('Instruksi Tugas')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <textarea id="description" name="description" rows="5" class="block mt-1.5 w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3.5 transition-all text-sm placeholder-slate-400 dark:placeholder-slate-500 outline-none" placeholder="Tuliskan petunjuk pengerjaan tugas di sini...">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Tenggat Waktu (Deadline) -->
                    <div>
                        <x-input-label for="deadline" :value="__('Tenggat Waktu (Deadline)')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="deadline" class="block mt-1.5 w-full" type="datetime-local" name="deadline" :value="old('deadline')" required />
                        <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <a href="{{ route('teacher.assignments.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Buat Tugas
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
