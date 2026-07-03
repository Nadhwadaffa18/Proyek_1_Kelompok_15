<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Tambah Soal Kuis') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <h3 class="font-bold text-xs text-slate-400 dark:text-slate-500 mb-6 uppercase tracking-wider font-mono">Kuis: {{ $quiz->title }}</h3>

                <form action="{{ route('teacher.quizzes.questions.store', $quiz->id) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Pertanyaan -->
                    <div>
                        <x-input-label for="question" :value="__('Pertanyaan / Soal')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <textarea id="question" name="question" rows="4" class="block mt-1.5 w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3.5 transition-all text-sm placeholder-slate-400 dark:placeholder-slate-500 outline-none" required autofocus placeholder="Tuliskan pertanyaan di sini...">{{ old('question') }}</textarea>
                        <x-input-error :messages="$errors->get('question')" class="mt-2" />
                    </div>

                    <!-- Pilihan Jawaban -->
                    <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <h4 class="font-bold text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-mono">Pilihan Jawaban (Multiple Choice)</h4>
                        
                        <!-- Pilihan A -->
                        <div>
                            <x-input-label for="option_a" :value="__('Pilihan A')" class="text-xs font-semibold text-slate-500" />
                            <x-text-input id="option_a" class="block mt-1.5 w-full text-sm" type="text" name="option_a" :value="old('option_a')" required placeholder="Teks untuk opsi A" />
                            <x-input-error :messages="$errors->get('option_a')" class="mt-2" />
                        </div>

                        <!-- Pilihan B -->
                        <div>
                            <x-input-label for="option_b" :value="__('Pilihan B')" class="text-xs font-semibold text-slate-500" />
                            <x-text-input id="option_b" class="block mt-1.5 w-full text-sm" type="text" name="option_b" :value="old('option_b')" required placeholder="Teks untuk opsi B" />
                            <x-input-error :messages="$errors->get('option_b')" class="mt-2" />
                        </div>

                        <!-- Pilihan C -->
                        <div>
                            <x-input-label for="option_c" :value="__('Pilihan C')" class="text-xs font-semibold text-slate-500" />
                            <x-text-input id="option_c" class="block mt-1.5 w-full text-sm" type="text" name="option_c" :value="old('option_c')" required placeholder="Teks untuk opsi C" />
                            <x-input-error :messages="$errors->get('option_c')" class="mt-2" />
                        </div>

                        <!-- Pilihan D -->
                        <div>
                            <x-input-label for="option_d" :value="__('Pilihan D')" class="text-xs font-semibold text-slate-500" />
                            <x-text-input id="option_d" class="block mt-1.5 w-full text-sm" type="text" name="option_d" :value="old('option_d')" required placeholder="Teks untuk opsi D" />
                            <x-input-error :messages="$errors->get('option_d')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Kunci Jawaban -->
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <x-input-label for="answer" :value="__('Kunci Jawaban yang Benar')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <select id="answer" name="answer" class="block mt-1.5 w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm" required>
                            <option value="" disabled selected>Pilih Kunci Jawaban</option>
                            <option value="A" {{ old('answer') === 'A' ? 'selected' : '' }}>Opsi A</option>
                            <option value="B" {{ old('answer') === 'B' ? 'selected' : '' }}>Opsi B</option>
                            <option value="C" {{ old('answer') === 'C' ? 'selected' : '' }}>Opsi C</option>
                            <option value="D" {{ old('answer') === 'D' ? 'selected' : '' }}>Opsi D</option>
                        </select>
                        <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Simpan Soal
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
