<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Guru Pengampu: <span class="text-indigo-600 dark:text-indigo-400 font-bold">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span></p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('forum.index', $class->id) }}" class="inline-flex items-center whitespace-nowrap px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Forum Diskusi
                </a>
                <a href="{{ route('student.classes.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert Messages -->
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

        <!-- Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Materi & Kuis -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Materi Pembelajaran -->
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-slate-900 dark:text-white">Materi Pembelajaran</h3>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-slate-100 dark:divide-slate-800/60">
                            @forelse ($class->materials as $material)
                                <li class="py-4 flex justify-between items-start first:pt-0 last:pb-0">
                                    <div class="space-y-1">
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm leading-snug">{{ $material->title }}</h4>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $material->description ?? 'Tidak ada deskripsi.' }}</p>
                                    </div>
                                    @if ($material->file_url)
                                        <a href="{{ route('student.materials.download', $material->id) }}" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-500/10 border border-indigo-500/10 px-3 py-1.5 rounded-lg hover:bg-indigo-600 hover:text-white transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Unduh
                                        </a>
                                    @endif
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 dark:text-slate-500 text-sm">Belum ada materi pembelajaran yang diunggah.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Jadwal Kelas -->
                <x-class-schedule :class="$class" />

                <!-- Kuis / Ujian -->
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-slate-900 dark:text-white">Kuis & Ujian</h3>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-slate-100 dark:divide-slate-800/60">
                            @forelse ($class->quizzes as $quiz)
                                @php
                                    $attempt = $quiz->attempts->first();
                                @endphp
                                <li class="py-4 flex justify-between items-center first:pt-0 last:pb-0">
                                    <div class="space-y-0.5">
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm leading-snug">{{ $quiz->title }}</h4>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono">Durasi: {{ $quiz->duration_minutes }} menit</p>
                                    </div>
                                    <div>
                                        @if ($attempt)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-500/10 border border-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-mono">
                                                SELESAI (SKOR: {{ $attempt->score }})
                                            </span>
                                        @else
                                            <a href="{{ route('student.quizzes.attempt', $quiz->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl transition-all shadow-sm active:scale-[0.98]">
                                                Mulai Mengerjakan
                                            </a>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 dark:text-slate-500 text-sm">Belum ada kuis yang tersedia.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Tugas & Pengumpulan -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tugas / Assignments</h3>
                
                @forelse ($class->assignments as $assignment)
                    @php
                        $submission = $assignment->submissions->first();
                        $isDeadlinePassed = now()->isAfter($assignment->deadline);
                    @endphp
                    <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 space-y-4 hover:shadow-soft-lg transition-all duration-300">
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-sm leading-snug">{{ $assignment->title }}</h4>
                            <p class="text-[10px] text-rose-600 dark:text-rose-400 font-bold font-mono mt-1">BATAS: {{ $assignment->deadline->format('d M Y H:i') }}</p>
                        </div>
                        
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $assignment->description }}</p>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800/80">
                            @if ($submission)
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-slate-400 font-bold">Status:</span>
                                        <span class="font-bold text-emerald-600 dark:text-emerald-400">Sudah Dikumpulkan</span>
                                    </div>
                                    @if ($submission->grade !== null)
                                        <div class="p-3 bg-emerald-500/5 border border-emerald-500/10 rounded-xl space-y-1">
                                            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-bold font-mono">NILAI: {{ $submission->grade }} / 100</p>
                                            <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium">Feedback: <span class="text-slate-700 dark:text-slate-300">{{ $submission->feedback ?? 'Tidak ada catatan.' }}</span></p>
                                        </div>
                                    @else
                                        <div class="p-3 bg-amber-500/5 border border-amber-500/10 rounded-xl flex items-center gap-1.5 text-xs text-amber-600 dark:text-amber-400 font-bold">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Menunggu Penilaian</span>
                                        </div>
                                    @endif
                                </div>
                            @elseif ($isDeadlinePassed)
                                <div class="p-3 bg-rose-500/5 border border-rose-500/10 rounded-xl text-center">
                                    <p class="text-xs text-rose-600 dark:text-rose-400 font-bold">Batas Pengumpulan Terlewati</p>
                                </div>
                            @else
                                <!-- Form Upload Tugas -->
                                <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-[10px] text-slate-400 font-bold mb-1.5 uppercase font-mono">UNGGAH BERKAS JAWABAN</label>
                                        <input type="file" name="file" class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-3 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-indigo-500/10 file:text-indigo-600 dark:file:bg-indigo-500/15 dark:file:text-indigo-400 hover:file:bg-indigo-600 hover:file:text-white transition-colors duration-150 cursor-pointer" required>
                                    </div>
                                    <x-primary-button class="w-full py-2 text-xs">
                                        Kumpulkan Tugas
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-slate-900 rounded-[18px] p-8 text-center text-slate-400 dark:text-slate-500 border border-slate-200/80 dark:border-slate-800/80 text-sm">
                        Belum ada tugas di kelas ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
