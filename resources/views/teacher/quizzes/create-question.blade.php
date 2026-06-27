<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Soal Kuis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <h3 class="font-bold text-sm text-gray-500 mb-6 uppercase tracking-wider">Kuis: {{ $quiz->title }}</h3>

                    <form action="{{ route('teacher.quizzes.questions.store', $quiz->id) }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Pertanyaan -->
                        <div>
                            <x-input-label for="question" :value="__('Pertanyaan / Soal')" />
                            <textarea id="question" name="question" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus placeholder="Tuliskan pertanyaan di sini...">{{ old('question') }}</textarea>
                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                        </div>

                        <!-- Pilihan Jawaban -->
                        <div class="space-y-4">
                            <h4 class="font-bold text-xs text-gray-400 uppercase tracking-wider">Pilihan Jawaban (Multiple Choice)</h4>
                            
                            <!-- Pilihan A -->
                            <div>
                                <x-input-label for="option_a" :value="__('Pilihan A')" />
                                <x-text-input id="option_a" class="block mt-1 w-full text-sm" type="text" name="option_a" :value="old('option_a')" required placeholder="Teks untuk opsi A" />
                                <x-input-error :messages="$errors->get('option_a')" class="mt-2" />
                            </div>

                            <!-- Pilihan B -->
                            <div>
                                <x-input-label for="option_b" :value="__('Pilihan B')" />
                                <x-text-input id="option_b" class="block mt-1 w-full text-sm" type="text" name="option_b" :value="old('option_b')" required placeholder="Teks untuk opsi B" />
                                <x-input-error :messages="$errors->get('option_b')" class="mt-2" />
                            </div>

                            <!-- Pilihan C -->
                            <div>
                                <x-input-label for="option_c" :value="__('Pilihan C')" />
                                <x-text-input id="option_c" class="block mt-1 w-full text-sm" type="text" name="option_c" :value="old('option_c')" required placeholder="Teks untuk opsi C" />
                                <x-input-error :messages="$errors->get('option_c')" class="mt-2" />
                            </div>

                            <!-- Pilihan D -->
                            <div>
                                <x-input-label for="option_d" :value="__('Pilihan D')" />
                                <x-text-input id="option_d" class="block mt-1 w-full text-sm" type="text" name="option_d" :value="old('option_d')" required placeholder="Teks untuk opsi D" />
                                <x-input-error :messages="$errors->get('option_d')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Kunci Jawaban -->
                        <div>
                            <x-input-label for="answer" :value="__('Kunci Jawaban yang Benar')" />
                            <select id="answer" name="answer" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                <option value="A" {{ old('answer') === 'A' ? 'selected' : '' }}>Opsi A</option>
                                <option value="B" {{ old('answer') === 'B' ? 'selected' : '' }}>Opsi B</option>
                                <option value="C" {{ old('answer') === 'C' ? 'selected' : '' }}>Opsi C</option>
                                <option value="D" {{ old('answer') === 'D' ? 'selected' : '' }}>Opsi D</option>
                            </select>
                            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-sm font-semibold rounded-xl text-white shadow-md shadow-indigo-500/10 hover:opacity-90 transform active:scale-[0.98] transition-all">
                                Simpan Soal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
