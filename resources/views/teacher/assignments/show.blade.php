<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ __('Detail Tugas & Pengumpulan') }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Kelas: {{ $assignment->class->name }}</p>
            </div>
            <a href="{{ route('teacher.classes.show', $assignment->class->id) }}" class="inline-flex items-center whitespace-nowrap text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Info Tugas -->
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 space-y-4">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $assignment->title }}</h3>
                <p class="text-xs text-rose-600 dark:text-rose-400 font-bold font-mono mt-1">TENGGAT WAKTU: {{ $assignment->deadline->format('d M Y H:i') }}</p>
            </div>
            <div class="text-sm text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-955 p-4 rounded-xl border border-slate-100 dark:border-slate-800/60">
                <p class="whitespace-pre-wrap leading-relaxed">{{ $assignment->description ?? 'Tidak ada instruksi khusus.' }}</p>
            </div>
        </div>

        <!-- Daftar Pengumpulan Siswa -->
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
                <h3 class="font-bold text-slate-900 dark:text-white">Pengumpulan Siswa ({{ $assignment->submissions->count() }})</h3>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    @forelse ($assignment->submissions as $submission)
                        <div class="p-6 bg-slate-50 dark:bg-slate-950/40 rounded-[18px] border border-slate-200/60 dark:border-slate-800 flex flex-col md:flex-row md:justify-between md:items-start gap-6 hover:shadow-sm transition-all duration-150">
                            <div class="space-y-4 flex-1">
                                <div class="flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-sm border border-indigo-500/15 uppercase">
                                        {{ substr($submission->student->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm leading-none">{{ $submission->student->name }}</h4>
                                        <span class="text-[10px] text-slate-400 font-mono mt-1.5 block">Dikumpulkan {{ $submission->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ Storage::url($submission->file_url) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-500/10 hover:bg-indigo-600 hover:text-white border border-indigo-500/10 px-3.5 py-2 rounded-xl transition-all">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Lihat/Unduh Tugas Siswa
                                    </a>
                                </div>

                                @if ($submission->grade !== null)
                                    <div class="p-4 bg-emerald-500/5 border border-emerald-500/10 rounded-xl space-y-1">
                                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-bold font-mono">NILAI: {{ $submission->grade }} / 100</p>
                                        <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">Feedback: <span class="text-slate-800 dark:text-slate-200">{{ $submission->feedback ?? 'Tidak ada feedback.' }}</span></p>
                                    </div>
                                @endif
                            </div>

                            <!-- Form Penilaian -->
                            <div class="w-full md:max-w-xs bg-white dark:bg-slate-900 p-5 rounded-xl border border-slate-200/80 dark:border-slate-800 shadow-sm space-y-4">
                                <h5 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider font-mono">
                                    {{ $submission->grade !== null ? 'Perbarui Nilai' : 'Beri Nilai' }}
                                </h5>
                                <form action="{{ route('teacher.submissions.grade', $submission->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-[10px] text-slate-400 font-bold mb-1.5 uppercase font-mono">NILAI (0 - 100)</label>
                                        <input type="number" name="grade" min="0" max="100" value="{{ $submission->grade }}" class="block w-full bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3 text-sm" required placeholder="Contoh: 85">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] text-slate-400 font-bold mb-1.5 uppercase font-mono">FEEDBACK (CATATAN)</label>
                                        <textarea name="feedback" rows="2" class="block w-full bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3 text-xs placeholder-slate-400 outline-none" placeholder="Bagus sekali, pertahankan!">{{ $submission->feedback }}</textarea>
                                    </div>
                                    <x-primary-button class="w-full py-2">
                                        Simpan Penilaian
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-slate-400 dark:text-slate-500 text-sm">
                            Belum ada siswa yang mengumpulkan tugas ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
