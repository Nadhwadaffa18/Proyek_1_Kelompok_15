<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full gap-4">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ __('Kelola Kuis / Ujian') }}
            </h2>
            <a href="{{ route('teacher.quizzes.create') }}" class="inline-flex items-center whitespace-nowrap px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Kuis
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 dark:border-slate-800/80 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                <th class="pb-4">Judul Kuis</th>
                                <th class="pb-4">Kelas</th>
                                <th class="pb-4">Durasi</th>
                                <th class="pb-4 text-center">Jumlah Soal</th>
                                <th class="pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                            @forelse ($quizzes as $quiz)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors duration-150">
                                    <td class="py-4 font-semibold text-slate-900 dark:text-white">{{ $quiz->title }}</td>
                                    <td class="py-4 font-medium text-slate-700 dark:text-slate-300">{{ $quiz->class->name }}</td>
                                    <td class="py-4 font-mono text-xs text-slate-500 dark:text-slate-400">{{ $quiz->duration_minutes }} menit</td>
                                    <td class="py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10">
                                            {{ $quiz->questions()->count() }} SOAL
                                        </span>
                                    </td>
                                    <td class="py-4 text-right space-x-3.5">
                                        <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="inline-flex items-center text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                            Kelola Kuis
                                        </a>
                                        <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kuis ini?')" class="inline-flex items-center text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400 dark:text-slate-500">Belum ada kuis yang dibuat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $quizzes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
