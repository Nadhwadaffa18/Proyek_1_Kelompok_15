<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full gap-4">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ __('Kelola Tugas / Assignment') }}
            </h2>
            <a href="{{ route('teacher.assignments.create') }}" class="inline-flex items-center whitespace-nowrap px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Tugas
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
                                <th class="pb-4">Judul Tugas</th>
                                <th class="pb-4">Kelas</th>
                                <th class="pb-4">Tenggat Waktu (Deadline)</th>
                                <th class="pb-4 text-center">Pengumpulan</th>
                                <th class="pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                            @forelse ($assignments as $assignment)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors duration-150">
                                    <td class="py-4 font-semibold text-slate-900 dark:text-white">{{ $assignment->title }}</td>
                                    <td class="py-4 font-medium text-slate-700 dark:text-slate-300">{{ $assignment->class->name }}</td>
                                    <td class="py-4 text-xs font-bold text-rose-600 dark:text-rose-400 font-mono">
                                        {{ $assignment->deadline->format('d M Y H:i') }}
                                    </td>
                                    <td class="py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10">
                                            {{ $assignment->submissions()->count() }} SISWA
                                        </span>
                                    </td>
                                    <td class="py-4 text-right space-x-3.5">
                                        <a href="{{ route('teacher.assignments.show', $assignment->id) }}" class="inline-flex items-center text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                            Detail & Nilai
                                        </a>
                                        <form action="{{ route('teacher.assignments.destroy', $assignment->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')" class="inline-flex items-center text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400 dark:text-slate-500">Belum ada tugas yang dibuat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $assignments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
