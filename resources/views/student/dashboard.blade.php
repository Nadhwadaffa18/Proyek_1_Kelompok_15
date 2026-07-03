<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert success/error -->
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Statistical Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Enrolled Classes -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['classes'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Kelas Diikuti</p>
                </div>
            </div>

            <!-- Total Assignments -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold flex items-center justify-center border border-emerald-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['assignments'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Tugas Tersedia</p>
                </div>
            </div>

            <!-- Total Quizzes -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 font-bold flex items-center justify-center border border-amber-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['quizzes'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Kuis Tersedia</p>
                </div>
            </div>
        </div>

        <!-- Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Enrolled Classes List -->
            <div class="lg:col-span-2 space-y-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">Kelas Saya</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($classes as $class)
                        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 p-6 flex flex-col justify-between hover:shadow-soft-lg hover:border-indigo-500/20 transition-all duration-300">
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/10 mb-4">JOINED</span>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $class->name }}</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Guru: <span class="font-medium text-slate-700 dark:text-slate-300">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                                </p>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('student.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 group">
                                    Buka Kelas
                                    <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-slate-900 rounded-[18px] p-8 text-center text-slate-400 dark:text-slate-500 border border-slate-200/80 dark:border-slate-800/80 col-span-2 space-y-4">
                            <p class="text-sm">Anda belum bergabung dengan kelas apa pun.</p>
                            <a href="{{ route('student.classes.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-xl transition-colors">
                                Cari & Join Kelas
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pending Assignments -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">Tugas Belum Selesai</h3>
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 space-y-4">
                    @forelse ($pendingAssignments as $assignment)
                        <div class="p-4 bg-rose-500/5 dark:bg-rose-500/10 border border-rose-500/10 rounded-xl transition-all hover:scale-[1.01]">
                            <h5 class="text-sm font-bold text-slate-900 dark:text-white mb-1">{{ $assignment->title }}</h5>
                            <p class="text-[10px] text-slate-400 font-semibold mb-2">Kelas: {{ $assignment->class->name }}</p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[10px] text-rose-600 dark:text-rose-400 font-semibold flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Batas: {{ $assignment->deadline->format('d M H:i') }}
                                </span>
                                <a href="{{ route('student.classes.show', $assignment->class->id) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                    Kumpulkan
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-400 dark:text-slate-500 text-sm">
                            Semua tugas sudah dikumpulkan! Keren! 👍
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
