<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Pengerjaan Kuis') }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Judul: {{ $quiz->title }}</p>
            </div>
            <!-- Live Timer -->
            <div class="flex items-center space-x-2 bg-rose-500/10 border border-rose-500/20 px-4 py-2 rounded-xl text-rose-600 dark:text-rose-400 font-bold text-sm">
                <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Sisa Waktu: </span>
                <span id="quiz-timer">--:--</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form id="quiz-form" action="{{ route('student.quizzes.submit', $quiz->id) }}" method="POST" class="space-y-8">
                @csrf

                @forelse ($quiz->questions as $index => $question)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                        <h3 class="font-bold text-base text-gray-900 dark:text-gray-100 flex gap-2">
                            <span>{{ $index + 1 }}.</span>
                            <span>{{ $question->question }}</span>
                        </h3>
                        
                        <div class="space-y-3">
                            <!-- Opsi A -->
                            <label class="flex items-center p-4 border border-gray-100 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-900 cursor-pointer transition-all">
                                <input type="radio" name="answers[{{ $question->id }}]" value="A" class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-700 mr-4" required>
                                <span class="text-sm text-gray-700 dark:text-gray-300">A. {{ $question->option_a }}</span>
                            </label>

                            <!-- Opsi B -->
                            <label class="flex items-center p-4 border border-gray-100 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-900 cursor-pointer transition-all">
                                <input type="radio" name="answers[{{ $question->id }}]" value="B" class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-700 mr-4">
                                <span class="text-sm text-gray-700 dark:text-gray-300">B. {{ $question->option_b }}</span>
                            </label>

                            <!-- Opsi C -->
                            <label class="flex items-center p-4 border border-gray-100 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-900 cursor-pointer transition-all">
                                <input type="radio" name="answers[{{ $question->id }}]" value="C" class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-700 mr-4">
                                <span class="text-sm text-gray-700 dark:text-gray-300">C. {{ $question->option_c }}</span>
                            </label>

                            <!-- Opsi D -->
                            <label class="flex items-center p-4 border border-gray-100 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-900 cursor-pointer transition-all">
                                <input type="radio" name="answers[{{ $question->id }}]" value="D" class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-700 mr-4">
                                <span class="text-sm text-gray-700 dark:text-gray-300">D. {{ $question->option_d }}</span>
                            </label>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center text-gray-400 border border-gray-100 dark:border-gray-700 text-sm">
                        Tidak ada soal dalam kuis ini.
                    </div>
                @endforelse

                @if ($quiz->questions->count() > 0)
                    <div class="flex justify-end">
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan kuis ini?')" class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-md">
                            Kirim Jawaban Kuis
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Timer Countdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let durationMinutes = {{ $quiz->duration_minutes }};
            let totalSeconds = durationMinutes * 60;
            let timerElement = document.getElementById('quiz-timer');
            let formElement = document.getElementById('quiz-form');

            let countdown = setInterval(function() {
                let minutes = Math.floor(totalSeconds / 60);
                let seconds = totalSeconds % 60;

                // Format values with leading zeroes
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                timerElement.innerText = minutes + ':' + seconds;

                if (totalSeconds <= 0) {
                    clearInterval(countdown);
                    alert('Waktu pengerjaan kuis telah habis! Jawaban Anda akan otomatis dikirim.');
                    // Disable confirmation trigger during automatic submission
                    formElement.onsubmit = null;
                    formElement.submit();
                }

                totalSeconds--;
            }, 1000);
        });
    </script>
</x-app-layout>
