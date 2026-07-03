<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert success -->
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistical Grid (Responsive 4/2/1) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Classes -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['classes'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Kelas Diajar</p>
                </div>
            </div>

            <!-- Materials -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold flex items-center justify-center border border-emerald-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['materials'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Total Materi</p>
                </div>
            </div>

            <!-- Assignments -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 font-bold flex items-center justify-center border border-amber-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['assignments'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Tugas Dibuat</p>
                </div>
            </div>

            <!-- Quizzes -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 font-bold flex items-center justify-center border border-rose-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['quizzes'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Kuis Aktif</p>
                </div>
            </div>
        </div>

        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Classes List -->
            <div class="lg:col-span-2 space-y-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">Daftar Kelas Diajar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($classes as $class)
                        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 p-6 flex flex-col justify-between hover:shadow-soft-lg hover:border-indigo-500/20 transition-all duration-300">
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10 mb-4">KELAS AKTIF</span>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $class->name }}</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Terdaftar <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $class->students()->count() }}</span> siswa
                                </p>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('teacher.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 group">
                                    Masuk Kelas
                                    <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-slate-900 rounded-[18px] p-8 text-center text-slate-400 dark:text-slate-500 border border-slate-200/80 dark:border-slate-800/80 col-span-2">
                            Anda belum terdaftar sebagai pengampu kelas apa pun.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Grading queue -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">Butuh Penilaian</h3>
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 space-y-4">
                    @forelse ($recentSubmissions as $submission)
                        <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl hover:bg-slate-100/50 dark:hover:bg-slate-800/60 border border-slate-200/40 dark:border-slate-800/40 transition-colors">
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="text-sm font-bold text-slate-900 dark:text-white">{{ $submission->student->name }}</h5>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $submission->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Tugas: <span class="font-medium text-slate-800 dark:text-slate-200">{{ $submission->assignment->title }}</span></p>
                            <p class="text-[10px] font-semibold text-indigo-600 dark:text-indigo-400 mb-3">Kelas: {{ $submission->assignment->class->name }}</p>
                            <a href="{{ route('teacher.assignments.show', $submission->assignment->id) }}" class="inline-flex w-full justify-center items-center py-2 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-950/40 dark:hover:bg-indigo-950/60 border border-indigo-100/20 text-indigo-600 dark:text-indigo-400 rounded-lg text-xs font-semibold transition-colors">
                                Buka & Beri Nilai
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-400 dark:text-slate-500 text-sm">
                            Semua pengumpulan tugas sudah dinilai! 
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
