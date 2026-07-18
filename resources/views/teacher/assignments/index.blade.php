<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between w-full gap-3">
            <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                {{ __('Kelola Tugas / Assignment') }}
            </h2>
            <a href="{{ route('teacher.assignments.create') }}" class="inline-flex items-center whitespace-nowrap px-5 py-2.5 bg-gradient-to-r from-primary to-secondary text-white text-sm font-semibold rounded-[14px] shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 w-fit">
                <i class="fa-solid fa-plus mr-1.5"></i>
                Buat Tugas
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white backdrop-blur-[18px] rounded-card border border-slate-200 shadow-soft overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <th class="pb-4">Judul Tugas</th>
                                <th class="pb-4">Kelas</th>
                                <th class="pb-4">Tenggat Waktu (Deadline)</th>
                                <th class="pb-4 text-center">Pengumpulan</th>
                                <th class="pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            @forelse ($assignments as $assignment)
                                <tr class="hover:bg-slate-100 transition-colors duration-150">
                                    <td class="py-4 font-bold text-slate-900 font-display">{{ $assignment->title }}</td>
                                    <td class="py-4 font-semibold text-slate-700">{{ $assignment->class->name }}</td>
                                    <td class="py-4 text-xs font-bold text-danger font-mono">
                                        {{ $assignment->deadline->format('d M Y H:i') }}
                                    </td>
                                    <td class="py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary border border-primary/10">
                                            {{ $assignment->submissions()->count() }} SISWA
                                        </span>
                                    </td>
                                    <td class="py-4 text-right space-x-3.5 whitespace-nowrap">
                                        <a href="{{ route('teacher.assignments.show', $assignment->id) }}" class="inline-flex items-center text-xs font-bold text-primary hover:underline">
                                            Detail & Nilai
                                        </a>
                                        <form action="{{ route('teacher.assignments.destroy', $assignment->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')" class="inline-flex items-center text-xs font-bold text-danger hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400">Belum ada tugas yang dibuat.</td>
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
