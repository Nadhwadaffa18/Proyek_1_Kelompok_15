<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full gap-4">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ __('Kelola Materi Pembelajaran') }}
            </h2>
            <a href="{{ route('teacher.materials.create') }}" class="inline-flex items-center whitespace-nowrap px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                <svg class="w-4 h-4. mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Unggah Materi
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
                                <th class="pb-4">Judul Materi</th>
                                <th class="pb-4">Kelas</th>
                                <th class="pb-4">Deskripsi</th>
                                <th class="pb-4">Berkas</th>
                                <th class="pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                            @forelse ($materials as $material)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors duration-150">
                                    <td class="py-4 font-semibold text-slate-900 dark:text-white">{{ $material->title }}</td>
                                    <td class="py-4 font-medium text-slate-700 dark:text-slate-300">{{ $material->class->name }}</td>
                                    <td class="py-4 text-xs max-w-xs truncate">{{ $material->description ?? '-' }}</td>
                                    <td class="py-4">
                                        @if ($material->file_url)
                                            <a href="{{ Storage::url($material->file_url) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-indigo-600 dark:text-indigo-400 font-bold hover:underline">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Unduh
                                            </a>
                                        @else
                                            <span class="text-xs text-slate-400 dark:text-slate-500 italic">Tidak ada berkas</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-right">
                                        <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')" class="inline-flex items-center text-xs font-bold text-rose-600 dark:text-rose-400 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400 dark:text-slate-500">Belum ada materi yang diunggah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $materials->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
