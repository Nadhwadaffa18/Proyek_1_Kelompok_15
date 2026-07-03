<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Buat Kuis / Ujian Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('teacher.quizzes.store') }}" method="POST" class="space-y-6">
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

                    <!-- Judul Kuis -->
                    <div>
                        <x-input-label for="title" :value="__('Judul Kuis')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="title" class="block mt-1.5 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Kuis Harian Larangan & Aturan Dasar" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Durasi (Menit) -->
                    <div>
                        <x-input-label for="duration_minutes" :value="__('Durasi Pengerjaan (Menit)')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="duration_minutes" class="block mt-1.5 w-full" type="number" name="duration_minutes" :value="old('duration_minutes', 30)" required min="1" placeholder="Contoh: 30" />
                        <x-input-error :messages="$errors->get('duration_minutes')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <a href="{{ route('teacher.quizzes.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Buat Kuis
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
