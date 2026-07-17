<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
            <div>
                <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                    {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold text-slate-900 uppercase tracking-wider mt-1.5">
                    Guru Pengampu: <span class="text-primary font-bold">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                </p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('forum.index', $class->id) }}" class="inline-flex items-center whitespace-nowrap px-5 py-2.5 bg-gradient-to-r from-primary to-secondary text-white text-sm font-semibold rounded-[14px] shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                    <i class="fa-solid fa-comments mr-2"></i>
                    Forum Diskusi
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert Messages -->
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

        <!-- Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Materi & Kuis -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Materi Pembelajaran -->
                <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-display font-bold text-slate-900">Materi Pembelajaran</h3>
                    </div>
                    <div class="p-6 bg-white">
                        <ul class="divide-y divide-slate-100">
                            @forelse ($class->materials as $material)
                                <li class="py-4 flex justify-between items-start first:pt-0 last:pb-0">
                                    <div class="space-y-1">
                                        <h4 class="font-display font-bold text-slate-900 text-sm leading-snug">{{ $material->title }}</h4>
                                        <p class="text-xs text-slate-500 leading-relaxed">{{ $material->description ?? 'Tidak ada deskripsi.' }}</p>
                                    </div>
                                    @if ($material->file_url)
                                        <a href="{{ route('student.materials.download', $material->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary bg-primary/10 border border-primary/10 px-3.5 py-2 rounded-lg hover:bg-primary hover:text-white transition-all">
                                            <i class="fa-solid fa-download text-xs"></i>
                                            Unduh
                                        </a>
                                    @endif
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 text-sm">Belum ada materi pembelajaran yang diunggah.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Jadwal Kelas -->
                <x-class-schedule :class="$class" />

                <!-- Kuis / Ujian -->
                <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-display font-bold text-slate-900">Kuis</h3>
                    </div>
                    <div class="p-6 bg-white">
                        <ul class="divide-y divide-slate-100">
                            @forelse ($class->quizzes as $quiz)
                                @php
                                    $attempt = $quiz->attempts->first();
                                @endphp
                                <li class="py-4 flex justify-between items-center first:pt-0 last:pb-0">
                                    <div class="space-y-0.5">
                                        <h4 class="font-display font-bold text-slate-900 text-sm leading-snug">{{ $quiz->title }}</h4>
                                        <p class="text-[10px] text-slate-450 font-semibold uppercase tracking-wider"><i class="fa-solid fa-clock mr-1"></i> Durasi: {{ $quiz->duration_minutes }} menit</p>
                                    </div>
                                    <div>
                                        @if ($attempt)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-500/10 border border-emerald-500/10 text-emerald-600 font-mono">
                                                SELESAI (SKOR: {{ $attempt->score }})
                                            </span>
                                        @else
                                            <a href="{{ route('student.quizzes.attempt', $quiz->id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white text-xs font-bold rounded-[14px] transition-all shadow-sm hover:scale-[1.02] active:scale-[0.98]">
                                                Mulai Mengerjakan
                                            </a>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 text-sm">Belum ada kuis yang tersedia.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Tugas & Pengumpulan -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold text-slate-900 font-display">Tugas / Assignments</h3>
                
                @forelse ($class->assignments as $assignment)
                    @php
                        $submission = $assignment->submissions->first();
                        $isDeadlinePassed = now()->isAfter($assignment->deadline);
                    @endphp
                    <div class="bg-white rounded-card border border-white/45 shadow-soft p-6 space-y-4 hover:shadow-soft-lg transition-all duration-300">
                        <div>
                            <h4 class="font-display font-bold text-slate-900 text-sm leading-snug">{{ $assignment->title }}</h4>
                            <p class="text-[10px] text-danger font-bold uppercase tracking-wider mt-1"><i class="fa-solid fa-clock mr-1"></i> BATAS: {{ $assignment->deadline->format('d M Y H:i') }}</p>
                        </div>
                        
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $assignment->description }}</p>

                        <div class="pt-4 border-t border-slate-100">
                            @if ($submission)
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-slate-400 font-bold">Status:</span>
                                        <span class="font-bold text-emerald-600"><i class="fa-solid fa-circle-check mr-1"></i> Sudah Dikumpulkan</span>
                                    </div>
                                    @if ($submission->grade !== null)
                                        <div class="p-3 bg-emerald-500/5 border border-emerald-500/10 rounded-xl space-y-1">
                                            <p class="text-xs text-emerald-600 font-bold font-mono">NILAI: {{ $submission->grade }} / 100</p>
                                            <p class="text-[10px] text-slate-500 font-semibold">Feedback: <span class="text-slate-700 font-medium">{{ $submission->feedback ?? 'Tidak ada catatan.' }}</span></p>
                                        </div>
                                    @else
                                        <div class="p-3 bg-amber-500/5 border border-amber-500/10 rounded-xl flex items-center gap-1.5 text-xs text-amber-600 font-bold">
                                            <i class="fa-solid fa-clock"></i>
                                            <span>Menunggu Penilaian</span>
                                        </div>
                                    @endif
                                </div>
                            @elseif ($isDeadlinePassed)
                                <div class="p-3 bg-rose-500/5 border border-rose-500/10 rounded-xl text-center">
                                    <p class="text-xs text-rose-600 font-bold">Batas Pengumpulan Terlewati</p>
                                </div>
                            @else
                                <!-- Form Upload Tugas -->
                                <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-[10px] text-slate-400 font-bold mb-1.5 uppercase font-mono">UNGGAH BERKAS JAWABAN</label>
                                        <input type="file" name="file" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary hover:file:text-white transition-colors duration-150 cursor-pointer" required>
                                    </div>
                                    <x-primary-button class="w-full text-xs font-bold py-3.5">
                                        Kumpulkan Tugas
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-card p-8 text-center text-slate-400 border border-white/45 text-sm">
                        Belum ada tugas di kelas ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
