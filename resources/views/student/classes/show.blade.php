<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Guru Pengampu: {{ $class->teacher->name ?? 'Belum Ditentukan' }}</p>
            </div>
            <a href="{{ route('student.classes.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Alert Messages -->
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

            <!-- Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri: Materi & Kuis -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Materi Pembelajaran -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Materi Pembelajaran</h3>
                        </div>
                        <div class="p-6">
                            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($class->materials as $material)
                                    <li class="py-4 flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $material->title }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ $material->description ?? 'Tidak ada deskripsi.' }}</p>
                                        </div>
                                        @if ($material->file_url)
                                            <a href="{{ route('student.materials.download', $material->id) }}" class="inline-flex items-center text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1.5 rounded-lg hover:bg-indigo-100 transition-colors">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Unduh
                                            </a>
                                        @endif
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-400 text-sm">Belum ada materi pembelajaran yang diunggah.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Jadwal Kelas -->
                    <x-class-schedule :class="$class" />

                    <!-- Kuis / Ujian -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Kuis & Ujian</h3>
                        </div>
                        <div class="p-6">
                            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($class->quizzes as $quiz)
                                    @php
                                        $attempt = $quiz->attempts->first();
                                    @endphp
                                    <li class="py-4 flex justify-between items-center">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $quiz->title }}</h4>
                                            <p class="text-[10px] text-gray-400 mt-1">Durasi: {{ $quiz->duration_minutes }} menit</p>
                                        </div>
                                        <div>
                                            @if ($attempt)
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                                    Selesai (Skor: {{ $attempt->score }})
                                                </span>
                                            @else
                                                <a href="{{ route('student.quizzes.attempt', $quiz->id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-xs font-semibold rounded-lg hover:opacity-90 transition-all">
                                                    Mulai Mengerjakan
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-400 text-sm">Belum ada kuis yang tersedia.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Tugas & Pengumpulan -->
                <div class="space-y-8">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Tugas / Assignments</h3>
                    
                    @forelse ($class->assignments as $assignment)
                        @php
                            $submission = $assignment->submissions->first();
                            $isDeadlinePassed = now()->isAfter($assignment->deadline);
                        @endphp
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 space-y-4">
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-gray-100 text-sm">{{ $assignment->title }}</h4>
                                <p class="text-[10px] text-rose-500 font-semibold mt-1">Batas: {{ $assignment->deadline->format('d M Y H:i') }}</p>
                            </div>
                            
                            <p class="text-xs text-gray-500 whitespace-pre-wrap">{{ $assignment->description }}</p>

                            <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                @if ($submission)
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center text-xs">
                                            <span class="text-gray-400">Status:</span>
                                            <span class="font-bold text-emerald-600">Sudah Dikumpulkan</span>
                                        </div>
                                        @if ($submission->grade !== null)
                                            <div class="p-3 bg-emerald-500/5 border border-emerald-500/20 rounded-xl space-y-1">
                                                <p class="text-xs text-emerald-600 dark:text-emerald-400 font-bold">Nilai: {{ $submission->grade }} / 100</p>
                                                <p class="text-[10px] text-gray-500">Feedback: {{ $submission->feedback ?? 'Tidak ada catatan.' }}</p>
                                            </div>
                                        @else
                                            <div class="p-3 bg-amber-500/5 border border-amber-500/20 rounded-xl">
                                                <p class="text-xs text-amber-600 dark:text-amber-400 font-bold">Menunggu Penilaian</p>
                                            </div>
                                        @endif
                                    </div>
                                @elseif ($isDeadlinePassed)
                                    <div class="p-3 bg-rose-500/5 border border-rose-500/20 rounded-xl text-center">
                                        <p class="text-xs text-rose-600 dark:text-rose-400 font-bold">Batas Pengumpulan Terlewati</p>
                                    </div>
                                @else
                                    <!-- Form Upload Tugas -->
                                    <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                        @csrf
                                        <div>
                                            <label class="block text-[10px] text-gray-400 font-semibold mb-1">UNGGAH BERKAS JAWABAN</label>
                                            <input type="file" name="file" class="block w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                                        </div>
                                        <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg text-xs font-semibold shadow-md hover:bg-indigo-700 transition-colors">
                                            Kumpulkan Tugas
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 text-center text-gray-400 border border-gray-100 dark:border-gray-700 text-sm">
                            Belum ada tugas di kelas ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
