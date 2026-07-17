<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert success/error -->
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Statistical Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Kelas Diikuti -->
            <div class="bg-white rounded-card border border-primary/60 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Kelas Diikuti</h3>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-graduation-cap text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                        {{ $stats['classes'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="text-sm text-slate-500">Kelas terdaftar</span>
                    </div>
                </div>
            </div>

            <!-- Tugas Tersedia -->
            <div class="bg-white rounded-card border border-primary/60 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Tugas Tersedia</h3>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-file-lines text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                        {{ $stats['assignments'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="text-sm text-slate-500">Tugas belum dikerjakan</span>
                    </div>
                </div>
            </div>

            <!-- Kuis Tersedia -->
            <div class="bg-white rounded-card border border-primary/60 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Kuis Tersedia</h3>
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-award text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                        {{ $stats['quizzes'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="text-sm text-slate-500">Kuis belum diselesaikan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Enrolled Classes List -->
            <div class="lg:col-span-2 space-y-6">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight font-display">Kelas Saya</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($classes as $class)
                        <div class="bg-white rounded-card border border-black/15 p-6 flex flex-col justify-between hover:scale-[1.02] hover:shadow-soft-lg hover:border-primary/20 transition-all duration-300">
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 border border-emerald-500/10 mb-4">JOINED</span>
                                <h4 class="text-lg font-bold text-slate-900 mb-2 font-display">{{ $class->name }}</h4>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5">
                                    <i class="fa-solid fa-user text-slate-400"></i>
                                    Guru: <span class="font-semibold text-slate-700">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                                </p>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('student.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-bold text-primary hover:text-secondary group">
                                    Buka Kelas
                                    <i class="fa-solid fa-arrow-right ml-1.5 transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-card border border-black/15 p-8 text-center text-slate-400 col-span-2 space-y-4">
                            <p class="text-sm">Anda belum bergabung dengan kelas apa pun.</p>
                            <a href="{{ route('student.classes.index') }}" class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary/95 text-white text-xs font-semibold rounded-xl transition-colors">
                                Cari & Join Kelas
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pending Assignments -->
            <div class="space-y-6">
                <div class="bg-white rounded-card border border-black/15 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h4 class="text-base font-bold text-slate-850 font-display">Tugas Belum Selesai</h4>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse ($pendingAssignments as $assignment)
                            <div class="p-4 bg-rose-50 border border-rose-100 rounded-xl transition-all hover:scale-[1.01]">
                                <h5 class="text-sm font-bold text-slate-900 mb-1 font-display">{{ $assignment->title }}</h5>
                                <p class="text-[10px] text-slate-400 font-semibold mb-2">Kelas: {{ $assignment->class->name }}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-[10px] text-danger font-bold flex items-center gap-1">
                                        <i class="fa-solid fa-clock"></i>
                                        Batas: {{ $assignment->deadline->format('d M H:i') }}
                                    </span>
                                    <a href="{{ route('student.classes.show', $assignment->class->id) }}" class="text-xs font-bold text-primary hover:underline">
                                        Kumpulkan
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-400 text-sm">
                                Semua tugas sudah dikumpulkan! Keren!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
