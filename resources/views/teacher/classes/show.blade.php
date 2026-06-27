<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Halaman detail manajemen kelas</p>
            </div>
            <a href="{{ route('teacher.dashboard') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Grid 3 Kolom Utama -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Kolom Kiri: Materi & Tugas -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Materi Pembelajaran -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Materi Pembelajaran</h3>
                            <a href="{{ route('teacher.materials.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-semibold rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors">
                                + Unggah Materi
                            </a>
                        </div>
                        <div class="p-6">
                            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($class->materials as $material)
                                    <li class="py-4 flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $material->title }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ $material->description ?? 'Tidak ada deskripsi.' }}</p>
                                            @if ($material->file_url)
                                                <a href="{{ Storage::url($material->file_url) }}" target="_blank" class="inline-flex items-center text-xs font-medium text-indigo-500 hover:text-indigo-700 mt-2">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    Unduh Berkas
                                                </a>
                                            @endif
                                        </div>
                                        <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus materi ini?')" class="text-xs text-rose-500 hover:text-rose-700 font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-400 text-sm">Belum ada materi pembelajaran yang diunggah.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Tugas / Assignment -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Daftar Tugas</h3>
                            <a href="{{ route('teacher.assignments.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-semibold rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors">
                                + Buat Tugas
                            </a>
                        </div>
                        <div class="p-6">
                            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($class->assignments as $assignment)
                                    <li class="py-4 flex justify-between items-center">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $assignment->title }}</h4>
                                            <p class="text-[10px] text-rose-500 font-semibold mt-1">Deadline: {{ $assignment->deadline->format('d M Y H:i') }}</p>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <a href="{{ route('teacher.assignments.show', $assignment->id) }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                                Detail & Penilaian ({{ $assignment->submissions()->count() }})
                                            </a>
                                            <form action="{{ route('teacher.assignments.destroy', $assignment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus tugas ini?')" class="text-xs text-rose-500 hover:text-rose-700 font-semibold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-400 text-sm">Belum ada tugas dibuat.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Kuis & Daftar Siswa -->
                <div class="space-y-8">
                    <!-- Kuis -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Kuis / Ujian</h3>
                            <a href="{{ route('teacher.quizzes.create', ['class_id' => $class->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-semibold rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors">
                                + Kuis Baru
                            </a>
                        </div>
                        <div class="p-6">
                            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($class->quizzes as $quiz)
                                    <li class="py-3 flex justify-between items-center">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $quiz->title }}</h4>
                                            <p class="text-[10px] text-gray-400 mt-0.5">Durasi: {{ $quiz->duration_minutes }} menit</p>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                                Kelola Soal ({{ $quiz->questions()->count() }})
                                            </a>
                                            <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus kuis ini?')" class="text-xs text-rose-500 hover:text-rose-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-3 text-center text-gray-400 text-sm">Belum ada kuis.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Daftar Siswa Terdaftar -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Siswa Terdaftar ({{ $class->students->count() }})</h3>
                        </div>
                        <div class="p-6">
                            <ul class="divide-y divide-gray-100 dark:divide-gray-700 max-h-96 overflow-y-auto">
                                @forelse ($class->students as $student)
                                    <li class="py-3 flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-600 font-bold text-xs uppercase">
                                            {{ substr($student->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm leading-none">{{ $student->name }}</h4>
                                            <span class="text-[10px] text-gray-400 mt-1 block">{{ $student->email }}</span>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-400 text-sm">Belum ada siswa bergabung ke kelas ini.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
