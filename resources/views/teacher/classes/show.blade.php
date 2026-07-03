<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Manajemen Aktivitas Pembelajaran Kelas</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('forum.index', $class->id) }}" class="inline-flex items-center whitespace-nowrap px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Forum Diskusi
                </a>
                <a href="{{ route('teacher.dashboard') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Grid 3 Kolom Utama -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri: Materi & Tugas -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Materi Pembelajaran -->
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-slate-900 dark:text-white">Materi Pembelajaran</h3>
                        <a href="{{ route('teacher.materials.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-bold rounded-lg border border-indigo-500/10 hover:bg-indigo-600 hover:text-white transition-all">
                            + Unggah Materi
                        </a>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-slate-100 dark:divide-slate-800/60">
                            @forelse ($class->materials as $material)
                                <li class="py-4 flex justify-between items-start first:pt-0 last:pb-0">
                                    <div class="space-y-1.5">
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $material->title }}</h4>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $material->description ?? 'Tidak ada deskripsi.' }}</p>
                                        @if ($material->file_url)
                                            <a href="{{ Storage::url($material->file_url) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline pt-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Unduh Berkas
                                            </a>
                                        @endif
                                    </div>
                                    <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 dark:text-slate-500 text-sm">Belum ada materi pembelajaran yang diunggah.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Tugas / Assignment -->
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-slate-900 dark:text-white">Daftar Tugas</h3>
                        <a href="{{ route('teacher.assignments.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-bold rounded-lg border border-indigo-500/10 hover:bg-indigo-600 hover:text-white transition-all">
                            + Buat Tugas
                        </a>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-slate-100 dark:divide-slate-800/60">
                            @forelse ($class->assignments as $assignment)
                                <li class="py-4 flex justify-between items-center first:pt-0 last:pb-0">
                                    <div class="space-y-1">
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $assignment->title }}</h4>
                                        <p class="text-[10px] text-rose-600 dark:text-rose-400 font-bold font-mono">TENGGAT: {{ $assignment->deadline->format('d M Y H:i') }}</p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('teacher.assignments.show', $assignment->id) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                            Detail & Nilai ({{ $assignment->submissions()->count() }})
                                        </a>
                                        <form action="{{ route('teacher.assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 dark:text-slate-500 text-sm">Belum ada tugas dibuat.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Kuis & Daftar Siswa -->
            <div class="space-y-8">
                <!-- Kuis -->
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-slate-900 dark:text-white">Kuis / Ujian</h3>
                        <a href="{{ route('teacher.quizzes.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-bold rounded-lg border border-indigo-500/10 hover:bg-indigo-600 hover:text-white transition-all">
                            + Kuis Baru
                        </a>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-slate-100 dark:divide-slate-800/60">
                            @forelse ($class->quizzes as $quiz)
                                <li class="py-3 flex justify-between items-center first:pt-0 last:pb-0">
                                    <div class="space-y-0.5">
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $quiz->title }}</h4>
                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono">Durasi: {{ $quiz->duration_minutes }} menit</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                            Kelola ({{ $quiz->questions()->count() }})
                                        </a>
                                        <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Hapus kuis ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="py-3 text-center text-slate-400 dark:text-slate-500 text-sm">Belum ada kuis.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Jadwal Kelas -->
                <x-class-schedule :class="$class" />

                <!-- Daftar Siswa Terdaftar -->
                <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-bold text-slate-900 dark:text-white">Siswa Terdaftar ({{ $class->students->count() }})</h3>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-slate-100 dark:divide-slate-800/60 max-h-96 overflow-y-auto pr-1">
                            @forelse ($class->students as $student)
                                <li class="py-3 flex items-center gap-3 first:pt-0 last:pb-0">
                                    <div class="w-8.5 h-8.5 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center text-xs uppercase shrink-0">
                                        {{ substr($student->name, 0, 2) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm leading-none truncate">{{ $student->name }}</h4>
                                        <span class="text-[10px] text-slate-400 dark:text-slate-500 font-mono mt-1 block truncate">{{ $student->email }}</span>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 dark:text-slate-500 text-sm">Belum ada siswa bergabung ke kelas ini.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
