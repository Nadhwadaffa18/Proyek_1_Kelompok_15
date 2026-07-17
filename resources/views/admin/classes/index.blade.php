<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between w-full gap-3">
            <h2 class="font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                {{ __('Kelola Kelas') }}
            </h2>
            <a href="{{ route('admin.classes.create') }}" class="flex-shrink-0 inline-flex items-center whitespace-nowrap px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kelas
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Alert Messages -->
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600  p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[18px] border border-slate-200/80  shadow-soft overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                <th class="pb-4">Nama Kelas</th>
                                <th class="pb-4">Guru Pengampu</th>
                                <th class="pb-4">Tanggal Dibuat</th>
                                <th class="pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            @forelse ($classes as $class)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                                    <td class="py-4 font-semibold text-slate-900 ">{{ $class->name }}</td>
                                    <td class="py-4 font-medium">
                                        @if($class->teacher)
                                            <span class="text-slate-700 ">{{ $class->teacher->name }}</span>
                                        @else
                                            <span class="text-slate-400 italic">Belum Ditentukan</span>
                                        @endif
                                    </td>
                                    <td class="py-4 font-mono text-xs text-slate-400">{{ $class->created_at->format('d M Y') }}</td>
                                    <td class="py-4 text-right space-x-3.5 whitespace-nowrap">
                                        <a href="{{ route('admin.classes.students', $class->id) }}" class="inline-flex items-center text-xs font-bold text-emerald-600 hover:underline">
                                            Siswa
                                        </a>
                                        <a href="{{ route('admin.schedules.index', $class->id) }}" class="inline-flex items-center text-xs font-bold text-amber-600 hover:underline">
                                            Jadwal
                                        </a>
                                        <a href="{{ route('admin.classes.edit', $class->id) }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:underline">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')" class="inline-flex items-center text-xs font-bold text-rose-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-slate-400 ">Belum ada kelas yang dibuat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $classes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
