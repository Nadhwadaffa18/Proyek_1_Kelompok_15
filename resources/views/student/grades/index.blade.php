<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Rekap Nilai Saya') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Nilai Tugas -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-bold text-slate-900 dark:text-white">Nilai Tugas & Essay</h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-800/80 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                    <th class="pb-3">Tugas</th>
                                    <th class="pb-3">Kelas</th>
                                    <th class="pb-3">Nilai</th>
                                    <th class="pb-3">Catatan Guru</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                                @forelse ($submissions as $submission)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-all duration-150">
                                        <td class="py-4 font-semibold text-slate-900 dark:text-white">{{ $submission->assignment->title }}</td>
                                        <td class="py-4 text-xs font-medium">{{ $submission->assignment->class->name }}</td>
                                        <td class="py-4">
                                            @if ($submission->grade !== null)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/10">
                                                    {{ $submission->grade }} / 100
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/10">
                                                    BELUM DINILAI
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 text-xs italic text-slate-500 dark:text-slate-400">
                                            {{ $submission->feedback ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-slate-400 dark:text-slate-500">Belum ada tugas yang dikumpulkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Nilai Kuis -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-bold text-slate-900 dark:text-white">Nilai Kuis Pilihan Ganda</h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-800/80 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                    <th class="pb-3">Kuis</th>
                                    <th class="pb-3">Kelas</th>
                                    <th class="pb-3">Skor Akhir</th>
                                    <th class="pb-3">Tanggal Mengerjakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                                @forelse ($quizAttempts as $attempt)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-all duration-150">
                                        <td class="py-4 font-semibold text-slate-900 dark:text-white">{{ $attempt->quiz->title }}</td>
                                        <td class="py-4 text-xs font-medium">{{ $attempt->quiz->class->name }}</td>
                                        <td class="py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10">
                                                {{ $attempt->score }} / 100
                                            </span>
                                        </td>
                                        <td class="py-4 text-xs font-mono text-slate-500 dark:text-slate-400">
                                            {{ $attempt->created_at->format('d M Y H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-slate-400 dark:text-slate-500">Belum ada kuis yang dikerjakan.</td>
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
