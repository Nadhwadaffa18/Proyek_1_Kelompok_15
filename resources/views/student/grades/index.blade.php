<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Rekap Nilai Saya') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Nilai Tugas -->
            <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-display font-bold text-slate-900">Nilai Tugas & Essay</h3>
                </div>
                <div class="p-6 bg-white">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="pb-3">Tugas</th>
                                    <th class="pb-3">Kelas</th>
                                    <th class="pb-3">Nilai</th>
                                    <th class="pb-3">Catatan Guru</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                                @forelse ($submissions as $submission)
                                    <tr class="hover:bg-slate-50/50 transition-all duration-150">
                                        <td class="py-4 font-bold text-slate-900 font-display">{{ $submission->assignment->title }}</td>
                                        <td class="py-4 text-xs font-semibold text-slate-700">{{ $submission->assignment->class->name }}</td>
                                        <td class="py-4">
                                            @if ($submission->grade !== null)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 border border-emerald-500/10">
                                                    {{ $submission->grade }} / 100
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-600 border border-amber-500/10">
                                                    BELUM DINILAI
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 text-xs italic text-slate-500">
                                            {{ $submission->feedback ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-slate-400">Belum ada tugas yang dikumpulkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Nilai Kuis -->
            <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-display font-bold text-slate-900">Nilai Kuis Pilihan Ganda</h3>
                </div>
                <div class="p-6 bg-white">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="pb-3">Kuis</th>
                                    <th class="pb-3">Kelas</th>
                                    <th class="pb-3">Skor Akhir</th>
                                    <th class="pb-3">Tanggal Mengerjakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                                @forelse ($quizAttempts as $attempt)
                                    <tr class="hover:bg-slate-100 transition-all duration-150">
                                        <td class="py-4 font-bold text-slate-900 font-display">{{ $attempt->quiz->title }}</td>
                                        <td class="py-4 text-xs font-semibold text-slate-700">{{ $attempt->quiz->class->name }}</td>
                                        <td class="py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary border border-primary/10">
                                                {{ $attempt->score }} / 100
                                            </span>
                                        </td>
                                        <td class="py-4 text-xs font-mono text-slate-500">
                                            {{ $attempt->created_at->format('d M Y H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-slate-400">Belum ada kuis yang dikerjakan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
