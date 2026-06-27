<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Materi Pembelajaran') }}
            </h2>
            <a href="{{ route('teacher.materials.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-sm font-semibold rounded-xl text-white shadow-md shadow-indigo-500/10 hover:opacity-90 transform active:scale-[0.98] transition-all">
                + Unggah Materi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <th class="pb-4">Judul Materi</th>
                                    <th class="pb-4">Kelas</th>
                                    <th class="pb-4">Deskripsi</th>
                                    <th class="pb-4">Berkas</th>
                                    <th class="pb-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                                @forelse ($materials as $material)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors duration-200">
                                        <td class="py-4 font-semibold text-gray-900 dark:text-gray-100">{{ $material->title }}</td>
                                        <td class="py-4">{{ $material->class->name }}</td>
                                        <td class="py-4 text-xs max-w-xs truncate">{{ $material->description ?? '-' }}</td>
                                        <td class="py-4">
                                            @if ($material->file_url)
                                                <a href="{{ Storage::url($material->file_url) }}" target="_blank" class="inline-flex items-center text-xs text-indigo-500 hover:text-indigo-700 font-medium">
                                                    Unduh
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400">Tidak ada berkas</span>
                                            @endif
                                        </td>
                                        <td class="py-4 text-right">
                                            <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')" class="inline-flex items-center text-sm font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-400">Belum ada materi yang diunggah.</td>
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
    </div>
</x-app-layout>
