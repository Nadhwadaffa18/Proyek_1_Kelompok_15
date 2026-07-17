<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert success -->
        @if (session('success'))
            <div class="bg-emerald-55 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistical Grid (Responsive 4/2/1) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Kelas Diajar -->
            <div class="bg-white rounded-card border border-primary/60 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Kelas Diajar</h3>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-graduation-cap text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                        {{ $stats['classes'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="text-sm text-slate-500">Kelas aktif diampu</span>
                    </div>
                </div>
            </div>

            <!-- Total Materi -->
            <div class="bg-white rounded-card border border-primary/60 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Total Materi</h3>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-book-open text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                        {{ $stats['materials'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="text-sm text-slate-500">Materi pembelajaran</span>
                    </div>
                </div>
            </div>

            <!-- Tugas Dibuat -->
            <div class="bg-white rounded-card border border-primary/60 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Tugas Dibuat</h3>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-file-lines text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                        {{ $stats['assignments'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="text-sm text-slate-500">Tugas untuk siswa</span>
                    </div>
                </div>
            </div>

            <!-- Kuis Aktif -->
            <div class="bg-white rounded-card border border-primary/60 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Kuis Aktif</h3>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-award text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                        {{ $stats['quizzes'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="text-sm text-slate-500">Kuis evaluasi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Classes List -->
            <div class="lg:col-span-2 space-y-6">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight font-display">Daftar Kelas Diajar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($classes as $class)
                        <div class="bg-white rounded-card border border-black/15 p-6 flex flex-col justify-between hover:scale-[1.02] hover:shadow-soft-lg hover:border-primary/20 transition-all duration-300">
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary border border-primary/10 mb-4">KELAS AKTIF</span>
                                <h4 class="text-lg font-bold text-slate-900 mb-2 font-display">{{ $class->name }}</h4>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5">
                                    <i class="fa-solid fa-user-group text-slate-400"></i>
                                    Terdaftar <span class="font-bold text-slate-700 ml-1">{{ $class->students()->count() }}</span> siswa
                                </p>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('teacher.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-bold text-primary hover:text-secondary group">
                                    Masuk Kelas
                                    <i class="fa-solid fa-arrow-right ml-1.5 transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-card border border-black/15 p-8 text-center text-slate-400 col-span-2">
                            Anda belum terdaftar sebagai pengampu kelas apa pun.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Grading queue -->
            <div class="space-y-6">
                <div class="bg-white rounded-card border border-black/15 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h4 class="text-base font-bold text-slate-850 font-display">Butuh Penilaian</h4>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse ($recentSubmissions as $submission)
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-slate-100/50 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <h5 class="text-sm font-bold text-slate-900 font-display">{{ $submission->student->name }}</h5>
                                    <span class="text-[10px] text-slate-400 font-mono">{{ $submission->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-slate-500 mb-1">Tugas: <span class="font-semibold text-slate-800">{{ $submission->assignment->title }}</span></p>
                                <p class="text-[10px] font-bold text-primary mb-3">Kelas: {{ $submission->assignment->class->name }}</p>
                                <a href="{{ route('teacher.assignments.show', $submission->assignment->id) }}" class="inline-flex w-full justify-center items-center py-2.5 bg-primary/8 hover:bg-primary/12 border border-primary/10 text-primary rounded-lg text-xs font-bold transition-all">
                                    Buka & Beri Nilai
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-400 text-sm">
                                Semua pengumpulan tugas sudah dinilai! 
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
