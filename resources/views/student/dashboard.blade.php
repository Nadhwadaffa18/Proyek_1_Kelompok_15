<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Alert success/error -->
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Statistical Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Enrolled Classes -->
                <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium uppercase tracking-wider">Kelas Diikuti</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['classes'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Assignments -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Tugas Tersedia</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['assignments'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Quizzes -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-sm font-medium uppercase tracking-wider">Kuis Tersedia</p>
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

            <!-- Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Enrolled Classes List -->
                <div class="lg:col-span-2 space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Kelas Saya</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse ($classes as $class)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 mb-4">Joined</span>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $class->name }}</h4>
                                    <p class="text-xs text-gray-400">Guru: {{ $class->teacher->name ?? 'Belum Ditentukan' }}</p>
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <a href="{{ route('student.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                        Buka Kelas
                                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center text-gray-400 border border-gray-100 dark:border-gray-700 col-span-2 space-y-4">
                                <p>Anda belum bergabung dengan kelas apa pun.</p>
                                <a href="{{ route('student.classes.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700">
                                    Cari & Join Kelas
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pending Assignments -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Tugas Belum Selesai</h3>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 space-y-4">
                        @forelse ($pendingAssignments as $assignment)
                            <div class="p-4 bg-rose-500/5 border border-rose-500/10 rounded-xl">
                                <h5 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $assignment->title }}</h5>
                                <p class="text-[10px] text-gray-400 mb-2">Kelas: {{ $assignment->class->name }}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-[10px] text-rose-500 font-semibold">Batas: {{ $assignment->deadline->format('d M H:i') }}</span>
                                    <a href="{{ route('student.classes.show', $assignment->class->id) }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                        Kumpulkan
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm">
                                Semua tugas sudah dikumpulkan! Keren! 👍
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
