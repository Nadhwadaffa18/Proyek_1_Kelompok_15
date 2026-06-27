<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Detail Tugas & Pengumpulan') }}
                </h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kelas: {{ $assignment->class->name }}</p>
            </div>
            <a href="{{ route('teacher.classes.show', $assignment->class->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Info Tugas -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 space-y-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $assignment->title }}</h3>
                    <p class="text-xs text-rose-500 font-semibold mt-1">Tenggat Waktu: {{ $assignment->deadline->format('d M Y H:i') }}</p>
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl">
                    <p class="whitespace-pre-wrap">{{ $assignment->description ?? 'Tidak ada instruksi khusus.' }}</p>
                </div>
            </div>

            <!-- Daftar Pengumpulan Siswa -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Pengumpulan Siswa ({{ $assignment->submissions->count() }})</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        @forelse ($assignment->submissions as $submission)
                            <div class="p-6 bg-gray-50 dark:bg-gray-900/40 rounded-2xl border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row md:justify-between md:items-start gap-6">
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-600 font-bold text-xs uppercase">
                                            {{ substr($submission->student->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 dark:text-gray-100 text-sm leading-none">{{ $submission->student->name }}</h4>
                                            <span class="text-[10px] text-gray-400 mt-1 block">Dikumpulkan {{ $submission->created_at->format('d M Y H:i') }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ Storage::url($submission->file_url) }}" target="_blank" class="inline-flex items-center text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1.5 rounded-lg hover:bg-indigo-100 transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Lihat/Unduh Tugas Siswa
                                        </a>
                                    </div>

                                    @if ($submission->grade !== null)
                                        <div class="p-4 bg-emerald-500/5 border border-emerald-500/20 rounded-xl space-y-1">
                                            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-bold">Nilai: {{ $submission->grade }} / 100</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Feedback: {{ $submission->feedback ?? 'Tidak ada feedback.' }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Form Penilaian -->
                                <div class="w-full md:max-w-xs bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
                                    <h5 class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-3">
                                        {{ $submission->grade !== null ? 'Perbarui Nilai' : 'Beri Nilai' }}
                                    </h5>
                                    <form action="{{ route('teacher.submissions.grade', $submission->id) }}" method="POST" class="space-y-3">
                                        @csrf
                                        <div>
                                            <label class="block text-[10px] text-gray-400 font-semibold mb-1">NILAI (0 - 100)</label>
                                            <input type="number" name="grade" min="0" max="100" value="{{ $submission->grade }}" class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] text-gray-400 font-semibold mb-1">FEEDBACK (CATATAN GURU)</label>
                                            <textarea name="feedback" rows="2" class="block w-full text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Bagus sekali, pertahankan!">{{ $submission->feedback }}</textarea>
                                        </div>
                                        <button type="submit" class="w-full py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg text-xs font-semibold shadow-md shadow-indigo-500/10 hover:opacity-90 transition-all">
                                            Simpan Penilaian
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400 text-sm">
                                Belum ada siswa yang mengumpulkan tugas ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
