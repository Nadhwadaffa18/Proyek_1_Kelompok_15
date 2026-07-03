<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ __('Pengerjaan Kuis') }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Kuis: {{ $quiz->title }}</p>
            </div>
            <!-- Live Timer -->
            <div class="flex items-center space-x-2.5 bg-rose-500/10 border border-rose-500/20 px-4 py-2.5 rounded-xl text-rose-600 dark:text-rose-400 font-bold text-sm shadow-sm select-none">
                <svg class="w-4.5 h-4.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-sans">Sisa Waktu:</span>
                <span id="quiz-timer" class="font-mono tracking-wider">--:--</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <form id="quiz-form" action="{{ route('student.quizzes.submit', $quiz->id) }}" method="POST" class="space-y-8">
            @csrf

            @forelse ($quiz->questions as $index => $question)
                <div class="bg-white dark:bg-slate-900 rounded-[18px] p-6 border border-slate-200/80 dark:border-slate-800/80 shadow-soft space-y-4 hover:shadow-soft-lg transition-all duration-300">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white flex gap-2">
                        <span class="font-mono text-slate-400">{{ $index + 1 }}.</span>
                        <span class="leading-relaxed">{{ $question->question }}</span>
                    </h3>
                    
                    <div class="space-y-3">
                        <!-- Opsi A -->
                        <label class="flex items-center p-4 border border-slate-200/60 dark:border-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/40 cursor-pointer transition-all duration-150 group">
                            <input type="radio" name="answers[{{ $question->id }}]" value="A" class="text-indigo-600 focus:ring-indigo-500 border-slate-300 dark:border-slate-700 mr-4 cursor-pointer" required>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white">A. {{ $question->option_a }}</span>
                        </label>

                        <!-- Opsi B -->
                        <label class="flex items-center p-4 border border-slate-200/60 dark:border-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/40 cursor-pointer transition-all duration-150 group">
                            <input type="radio" name="answers[{{ $question->id }}]" value="B" class="text-indigo-600 focus:ring-indigo-500 border-slate-300 dark:border-slate-700 mr-4 cursor-pointer">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white">B. {{ $question->option_b }}</span>
                        </label>

                        <!-- Opsi C -->
                        <label class="flex items-center p-4 border border-slate-200/60 dark:border-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/40 cursor-pointer transition-all duration-150 group">
                            <input type="radio" name="answers[{{ $question->id }}]" value="C" class="text-indigo-600 focus:ring-indigo-500 border-slate-300 dark:border-slate-700 mr-4 cursor-pointer">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white">C. {{ $question->option_c }}</span>
                        </label>

                        <!-- Opsi D -->
                        <label class="flex items-center p-4 border border-slate-200/60 dark:border-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/40 cursor-pointer transition-all duration-150 group">
                            <input type="radio" name="answers[{{ $question->id }}]" value="D" class="text-indigo-600 focus:ring-indigo-500 border-slate-300 dark:border-slate-700 mr-4 cursor-pointer">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white">D. {{ $question->option_d }}</span>
                        </label>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-slate-900 rounded-[18px] p-8 text-center text-slate-400 dark:text-slate-500 border border-slate-200/80 dark:border-slate-800/80 text-sm shadow-soft">
                    Tidak ada soal dalam kuis ini.
                </div>
            @endforelse

            @if ($quiz->questions->count() > 0)
                <div class="flex justify-end pt-4 border-t border-slate-200/60 dark:border-slate-800/60">
                    <x-primary-button class="px-6 py-3">
                        Kirim Jawaban Kuis
                    </x-primary-button>
                </div>
            @endif
        </form>
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
