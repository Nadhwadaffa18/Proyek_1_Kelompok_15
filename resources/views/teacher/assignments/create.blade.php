<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Buat Tugas Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white rounded-[18px] border border-slate-200/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('teacher.assignments.store') }}" method="POST" class="space-y-6">
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

                    <!-- Judul Tugas -->
                    <div>
                        <x-input-label for="title" :value="__('Judul Tugas')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                        <x-text-input id="title" class="block mt-1.5 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Latihan Soal Algoritma Pemrograman" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Deskripsi / Instruksi -->
                    <div>
                        <x-input-label for="description" :value="__('Instruksi Tugas')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                        <textarea id="description" name="description" rows="5" class="block mt-1.5 w-full bg-white text-slate-900 border border-slate-200 focus:border-primary focus:ring-1 focus:ring-primary rounded-[12px] shadow-sm py-3 px-4 transition-all text-sm placeholder-slate-400 outline-none resize-none" placeholder="Tuliskan petunjuk pengerjaan tugas di sini...">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Tenggat Waktu (Deadline) -->
                    <div>
                        <x-input-label for="deadline" :value="__('Tenggat Waktu (Deadline)')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                        <x-text-input id="deadline" class="block mt-1.5 w-full" type="datetime-local" name="deadline" :value="old('deadline')" required />
                        <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-200">
                        <a href="{{ route('teacher.assignments.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
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
