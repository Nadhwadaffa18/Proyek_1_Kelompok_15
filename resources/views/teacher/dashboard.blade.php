<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Alert success -->
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistical Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Classes -->
                <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium uppercase tracking-wider">Kelas Diajar</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['classes'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Materials -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Total Materi</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['materials'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Assignments -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-sm font-medium uppercase tracking-wider">Tugas Dibuat</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['assignments'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Quizzes -->
                <div class="bg-gradient-to-br from-rose-500 to-pink-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-rose-100 text-sm font-medium uppercase tracking-wider">Kuis Aktif</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['quizzes'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Classes List -->
                <div class="lg:col-span-2 space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Daftar Kelas Diajar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse ($classes as $class)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 flex flex-col justify-between hover:shadow-lg hover:border-indigo-500/20 transition-all duration-300">
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300 mb-4">Kelas Aktif</span>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $class->name }}</h4>
                                    <p class="text-xs text-gray-400">Terdaftar {{ $class->students()->count() }} siswa</p>
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <a href="{{ route('teacher.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                        Masuk Kelas
                                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 text-center text-gray-400 border border-gray-100 dark:border-gray-700 col-span-2">
                                Anda belum terdaftar sebagai pengampu kelas apa pun.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Grading queue -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Butuh Penilaian</h3>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 space-y-4">
                        @forelse ($recentSubmissions as $submission)
                            <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl hover:bg-gray-100/50 dark:hover:bg-gray-900 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <h5 class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $submission->student->name }}</h5>
                                    <span class="text-[10px] text-gray-400">{{ $submission->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mb-1">Tugas: <span class="font-medium">{{ $submission->assignment->title }}</span></p>
                                <p class="text-[10px] text-indigo-600 dark:text-indigo-400 mb-3">Kelas: {{ $submission->assignment->class->name }}</p>
                                <a href="{{ route('teacher.assignments.show', $submission->assignment->id) }}" class="inline-flex w-full justify-center items-center py-2 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-lg text-xs font-semibold hover:bg-indigo-100 dark:hover:bg-indigo-900/30 transition-colors">
                                    Buka & Beri Nilai
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm">
                                Semua pengumpulan tugas sudah dinilai! 🎉
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
