<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full gap-4">
            <div>
                <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                    {{ __('Detail Tugas & Pengumpulan') }}
                </h2>
                <p class="text-xs font-semibold text-slate-900 uppercase tracking-wider mt-1.5">Kelas: {{ $assignment->class->name }}</p>
            </div>

        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Info Tugas -->
        <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft p-6 space-y-4">
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-display">{{ $assignment->title }}</h3>
                <p class="text-xs text-danger font-bold uppercase tracking-wider font-mono mt-1"><i class="fa-solid fa-clock mr-1"></i> TENGGAT WAKTU: {{ $assignment->deadline->format('d M Y H:i') }}</p>
            </div>
            <div class="text-sm text-slate-650 bg-slate-50 p-4 rounded-xl border border-slate-100">
                <p class="whitespace-pre-wrap leading-relaxed">{{ $assignment->description ?? 'Tidak ada instruksi khusus.' }}</p>
            </div>
        </div>

        <!-- Daftar Pengumpulan Siswa -->
        <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-display font-bold text-slate-900">Pengumpulan Siswa ({{ $assignment->submissions->count() }})</h3>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    @forelse ($assignment->submissions as $submission)
                        <div class="p-6 bg-slate-50 rounded-card border border-slate-100 flex flex-col md:flex-row md:justify-between md:items-start gap-6 hover:shadow-sm transition-all duration-150">
                            <div class="space-y-4 flex-1">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-bold text-sm border border-primary/15 uppercase">
                                        {{ substr($submission->student->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h4 class="font-display font-bold text-slate-900 text-sm leading-none">{{ $submission->student->name }}</h4>
                                        <span class="text-[10px] text-slate-400 font-mono mt-1.5 block">Dikumpulkan {{ $submission->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ Storage::url($submission->file_url) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary bg-primary/10 hover:bg-primary hover:text-white border border-primary/10 px-3.5 py-2 rounded-[14px] transition-all">
                                        <i class="fa-solid fa-download"></i>
                                        Lihat/Unduh Tugas Siswa
                                    </a>
                                </div>

                                @if ($submission->grade !== null)
                                    <div class="p-4 bg-emerald-500/5 border border-emerald-500/10 rounded-xl space-y-1">
                                        <p class="text-xs text-emerald-600 font-bold font-mono">NILAI: {{ $submission->grade }} / 100</p>
                                        <p class="text-xs text-slate-600 font-medium">Feedback: <span class="text-slate-800">{{ $submission->feedback ?? 'Tidak ada feedback.' }}</span></p>
                                    </div>
                                @endif
                            </div>

                            <!-- Form Penilaian -->
                            <div class="w-full md:max-w-xs bg-white p-5 rounded-xl border border-slate-200/80 shadow-sm space-y-4">
                                <h5 class="text-xs font-bold text-slate-800 uppercase tracking-wider font-mono">
                                    {{ $submission->grade !== null ? 'Perbarui Nilai' : 'Beri Nilai' }}
                                </h5>
                                <form action="{{ route('teacher.submissions.grade', $submission->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-[10px] text-slate-400 font-bold mb-1.5 uppercase font-mono">NILAI (0 - 100)</label>
                                        <input type="number" name="grade" min="0" max="100" value="{{ $submission->grade }}" class="block w-full bg-white text-slate-900 border border-slate-200 focus:border-primary focus:ring-1 focus:ring-primary rounded-[12px] shadow-sm py-3 px-4 text-sm outline-none" required placeholder="Contoh: 85">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] text-slate-400 font-bold mb-1.5 uppercase font-mono">FEEDBACK (CATATAN)</label>
                                        <textarea name="feedback" rows="2" class="block w-full bg-white text-slate-900 border border-slate-200 focus:border-primary focus:ring-1 focus:ring-primary rounded-[12px] shadow-sm py-3 px-4 text-xs placeholder-slate-400 outline-none resize-none" placeholder="Bagus sekali, pertahankan!">{{ $submission->feedback }}</textarea>
                                    </div>
                                    <x-primary-button class="w-full py-3">
                                        Simpan Penilaian
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-slate-400 text-sm">
                            Belum ada siswa yang mengumpulkan tugas ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
