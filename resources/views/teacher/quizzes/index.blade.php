<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Kuis / Ujian') }}
            </h2>
            <a href="{{ route('teacher.quizzes.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-sm font-semibold rounded-xl text-white shadow-md shadow-indigo-500/10 hover:opacity-90 transform active:scale-[0.98] transition-all">
                + Kuis Baru
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
                                    <th class="pb-4">Judul Kuis</th>
                                    <th class="pb-4">Kelas</th>
                                    <th class="pb-4">Durasi</th>
                                    <th class="pb-4 text-center">Jumlah Soal</th>
                                    <th class="pb-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                                @forelse ($quizzes as $quiz)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors duration-200">
                                        <td class="py-4 font-semibold text-gray-900 dark:text-gray-100">{{ $quiz->title }}</td>
                                        <td class="py-4">{{ $quiz->class->name }}</td>
                                        <td class="py-4 font-medium">{{ $quiz->duration_minutes }} menit</td>
                                        <td class="py-4 text-center font-medium text-indigo-600 dark:text-indigo-400">
                                            {{ $quiz->questions()->count() }} soal
                                        </td>
                                        <td class="py-4 text-right space-x-3">
                                            <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                                Kelola Kuis
                                            </a>
                                            <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kuis ini?')" class="inline-flex items-center text-sm font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-400">Belum ada kuis yang dibuat.</td>
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
    </div>
</x-app-layout>
