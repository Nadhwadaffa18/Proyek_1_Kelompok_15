<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rekap Nilai Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Nilai Tugas -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Nilai Tugas & Essay</h3>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        <th class="pb-3">Tugas</th>
                                        <th class="pb-3">Kelas</th>
                                        <th class="pb-3">Nilai</th>
                                        <th class="pb-3">Catatan Guru</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                                    @forelse ($submissions as $submission)
                                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-all">
                                            <td class="py-4 font-semibold text-gray-900 dark:text-gray-100">{{ $submission->assignment->title }}</td>
                                            <td class="py-4 text-xs">{{ $submission->assignment->class->name }}</td>
                                            <td class="py-4">
                                                @if ($submission->grade !== null)
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                                        {{ $submission->grade }} / 100
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300">
                                                        Belum Dinilai
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 text-xs italic text-gray-500 dark:text-gray-400">
                                                {{ $submission->feedback ?? '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-6 text-center text-gray-400">Belum ada tugas yang dikumpulkan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Nilai Kuis -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">Nilai Kuis Pilihan Ganda</h3>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        <th class="pb-3">Kuis</th>
                                        <th class="pb-3">Kelas</th>
                                        <th class="pb-3">Skor Akhir</th>
                                        <th class="pb-3">Tanggal Mengerjakan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                                    @forelse ($quizAttempts as $attempt)
                                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-all">
                                            <td class="py-4 font-semibold text-gray-900 dark:text-gray-100">{{ $attempt->quiz->title }}</td>
                                            <td class="py-4 text-xs">{{ $attempt->quiz->class->name }}</td>
                                            <td class="py-4">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300">
                                                    {{ $attempt->score }} / 100
                                                </span>
                                            </td>
                                            <td class="py-4 text-xs">
                                                {{ $attempt->created_at->format('d M Y H:i') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-6 text-center text-gray-400">Belum ada kuis yang dikerjakan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
