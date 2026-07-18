<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
            <div>
                <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                    {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold text-slate-900 uppercase tracking-wider mt-1.5">Manajemen Aktivitas Pembelajaran Kelas</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('forum.index', $class->id) }}" class="inline-flex items-center whitespace-nowrap px-5 py-2.5 bg-gradient-to-r from-primary to-secondary text-white text-sm font-semibold rounded-[14px] shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                    <i class="fa-solid fa-comments mr-2"></i>
                    Forum Diskusi
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
                <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-display font-bold text-slate-900">Materi Pembelajaran</h3>
                        <a href="{{ route('teacher.materials.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3.5 py-2 bg-primary/10 text-primary text-xs font-bold rounded-lg border border-primary/10 hover:bg-primary hover:text-white transition-all">
                            <i class="fa-solid fa-plus mr-1"></i> Unggah Materi
                        </a>
                    </div>
                    <div class="p-6 bg-white">
                        <ul class="divide-y divide-slate-100">
                            @forelse ($class->materials as $material)
                                <li class="py-4 flex flex-col sm:flex-row sm:items-start justify-between gap-3 first:pt-0 last:pb-0">
                                    <div class="space-y-1.5">
                                        <h4 class="font-display font-bold text-slate-900 text-sm">{{ $material->title }}</h4>
                                        <p class="text-xs text-slate-500 leading-relaxed">{{ $material->description ?? 'Tidak ada deskripsi.' }}</p>
                                        @if ($material->file_url)
                                            <a href="{{ Storage::url($material->file_url) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:underline pt-1">
                                                <i class="fa-solid fa-download"></i>
                                                Unduh Berkas
                                            </a>
                                        @endif
                                    </div>
                                    <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-danger hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 text-sm">Belum ada materi pembelajaran yang diunggah.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Tugas / Assignment -->
                <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-display font-bold text-slate-900">Daftar Tugas</h3>
                        <a href="{{ route('teacher.assignments.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3.5 py-2 bg-primary/10 text-primary text-xs font-bold rounded-lg border border-primary/10 hover:bg-primary hover:text-white transition-all">
                            <i class="fa-solid fa-plus mr-1"></i> Buat Tugas
                        </a>
                    </div>
                    <div class="p-6 bg-white">
                        <ul class="divide-y divide-slate-100">
                            @forelse ($class->assignments as $assignment)
                                <li class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 first:pt-0 last:pb-0">
                                    <div class="space-y-1">
                                        <h4 class="font-display font-bold text-slate-900 text-sm">{{ $assignment->title }}</h4>
                                        <p class="text-[10px] text-danger font-bold uppercase tracking-wider font-mono"><i class="fa-solid fa-clock mr-1"></i> TENGGAT: {{ $assignment->deadline->format('d M Y H:i') }}</p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('teacher.assignments.show', $assignment->id) }}" class="text-xs font-bold text-primary hover:underline">
                                            Detail & Nilai ({{ $assignment->submissions()->count() }})
                                        </a>
                                        <form action="{{ route('teacher.assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-bold text-danger hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 text-sm">Belum ada tugas dibuat.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Kuis & Daftar Siswa -->
            <div class="space-y-8">
                <!-- Kuis -->
                <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-display font-bold text-slate-900">Kuis / Ujian</h3>
                        <a href="{{ route('teacher.quizzes.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3.5 py-2 bg-primary/10 text-primary text-xs font-bold rounded-lg border border-primary/10 hover:bg-primary hover:text-white transition-all">
                            <i class="fa-solid fa-plus mr-1"></i> Kuis Baru
                        </a>
                    </div>
                    <div class="p-6 bg-white">
                        <ul class="divide-y divide-slate-100">
                            @forelse ($class->quizzes as $quiz)
                                <li class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 first:pt-0 last:pb-0">
                                    <div class="space-y-0.5">
                                        <h4 class="font-display font-bold text-slate-900 text-sm">{{ $quiz->title }}</h4>
                                        <p class="text-[10px] text-slate-450 font-bold uppercase tracking-wider font-mono"><i class="fa-solid fa-clock mr-1"></i> Durasi: {{ $quiz->duration_minutes }} menit</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="text-xs font-bold text-primary hover:underline">
                                            Kelola ({{ $quiz->questions()->count() }})
                                        </a>
                                        <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Hapus kuis ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-bold text-danger hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="py-3 text-center text-slate-400 text-sm">Belum ada kuis.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Jadwal Kelas -->
                <x-class-schedule :class="$class"/>

                <!-- Daftar Siswa Terdaftar -->
                <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-display font-bold text-slate-900">Siswa Terdaftar ({{ $class->students->count() }})</h3>
                    </div>
                    <div class="p-6 bg-white">
                        <ul class="divide-y divide-slate-100 max-h-96 overflow-y-auto pr-1">
                            @forelse ($class->students as $student)
                                <li class="py-3 flex items-center gap-3 first:pt-0 last:pb-0">
                                    <div class="w-8.5 h-8.5 rounded-lg bg-primary/10 text-primary font-bold flex items-center justify-center text-xs uppercase shrink-0">
                                        {{ substr($student->name, 0, 2) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-display font-bold text-slate-900 text-sm leading-none truncate">{{ $student->name }}</h4>
                                        <span class="text-[10px] text-slate-400 font-mono mt-1 block truncate">{{ $student->email }}</span>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-slate-400 text-sm">Belum ada siswa bergabung ke kelas ini.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
