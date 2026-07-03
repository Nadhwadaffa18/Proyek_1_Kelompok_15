<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ __('Detail Kuis & Kelola Soal') }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Kelas: {{ $quiz->class->name }} | Durasi: {{ $quiz->duration_minutes }} menit</p>
            </div>
            <a href="{{ route('teacher.classes.show', $quiz->class->id) }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Daftar Soal -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Soal Pilihan Ganda</h3>
                    <a href="{{ route('teacher.quizzes.questions.create', $quiz->id) }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-xs font-bold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Soal
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($quiz->questions as $index => $question)
                        <div class="bg-white dark:bg-slate-900 rounded-[18px] p-6 border border-slate-200/80 dark:border-slate-800/80 shadow-soft relative space-y-4 hover:shadow-soft-lg transition-all duration-300">
                            <div class="flex justify-between items-start gap-4">
                                <h4 class="font-bold text-sm text-slate-900 dark:text-white flex gap-2">
                                    <span>{{ $index + 1 }}.</span>
                                    <span class="leading-relaxed">{{ $question->question }}</span>
                                </h4>
                                <form action="{{ route('teacher.quizzes.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline shrink-0">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                                <div class="p-3.5 rounded-xl border {{ $question->answer === 'A' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-600 dark:text-emerald-400 font-bold' : 'border-slate-200/60 dark:border-slate-800/60 text-slate-600 dark:text-slate-300' }}">
                                    <span class="font-bold mr-1 font-mono">A.</span> {{ $question->option_a }}
                                </div>
                                <div class="p-3.5 rounded-xl border {{ $question->answer === 'B' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-600 dark:text-emerald-400 font-bold' : 'border-slate-200/60 dark:border-slate-800/60 text-slate-600 dark:text-slate-300' }}">
                                    <span class="font-bold mr-1 font-mono">B.</span> {{ $question->option_b }}
                                </div>
                                <div class="p-3.5 rounded-xl border {{ $question->answer === 'C' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-600 dark:text-emerald-400 font-bold' : 'border-slate-200/60 dark:border-slate-800/60 text-slate-600 dark:text-slate-300' }}">
                                    <span class="font-bold mr-1 font-mono">C.</span> {{ $question->option_c }}
                                </div>
                                <div class="p-3.5 rounded-xl border {{ $question->answer === 'D' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-600 dark:text-emerald-400 font-bold' : 'border-slate-200/60 dark:border-slate-800/60 text-slate-600 dark:text-slate-300' }}">
                                    <span class="font-bold mr-1 font-mono">D.</span> {{ $question->option_d }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-slate-900 rounded-[18px] p-8 text-center text-slate-400 dark:text-slate-500 border border-slate-200/80 dark:border-slate-800/80 text-sm">
                            Belum ada soal ditambahkan ke kuis ini. Silakan klik "+ Tambah Soal" di atas.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Kolom Kanan: Hasil Pengerjaan Siswa -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Hasil Kuis Siswa</h3>
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6">
                    <ul class="divide-y divide-slate-100 dark:divide-slate-800/60 max-h-[500px] overflow-y-auto pr-1">
                        @forelse ($quiz->attempts as $attempt)
                            <li class="py-3.5 flex justify-between items-center hover:bg-slate-50/20 transition-all">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8.5 h-8.5 rounded-lg bg-indigo-500/10 border border-indigo-500/15 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center text-xs uppercase shrink-0">
                                        {{ substr($attempt->student->name, 0, 2) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-slate-800 dark:text-white text-sm leading-none truncate">{{ $attempt->student->name }}</h4>
                                        <span class="text-[10px] text-slate-400 dark:text-slate-500 font-mono mt-1 block truncate">{{ $attempt->student->email }}</span>
                                    </div>
                                </div>
                                <div class="bg-indigo-500/10 border border-indigo-500/10 px-3 py-1.5 rounded-lg text-xs font-bold font-mono text-indigo-600 dark:text-indigo-400 shrink-0">
                                    Skor: {{ $attempt->score }}
                                </div>
                            </li>
                        @empty
                            <li class="py-6 text-center text-slate-400 dark:text-slate-500 text-sm">Belum ada siswa yang mengerjakan kuis ini.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
