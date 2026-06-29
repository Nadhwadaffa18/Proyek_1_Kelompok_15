<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                ✏️ Edit Jadwal — {{ $class->name }}
            </h2>
            <a href="{{ route('admin.schedules.index', $class->id) }}"
               class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Hanya <strong>hari & waktu</strong> yang dapat diubah di sini. Link pertemuan diatur oleh guru.
                    </p>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.schedules.update', [$class->id, $schedule->id]) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Hari</label>
                            <select name="day" required
                                class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                @foreach ($days as $day)
                                    <option value="{{ $day }}" {{ old('day', $schedule->day) === $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('day')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Jam Mulai</label>
                                <input type="time" name="start_time" value="{{ old('start_time', substr($schedule->start_time, 0, 5)) }}" required
                                    class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                @error('start_time')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Jam Selesai</label>
                                <input type="time" name="end_time" value="{{ old('end_time', substr($schedule->end_time, 0, 5)) }}" required
                                    class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                @error('end_time')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            <a href="{{ route('admin.schedules.index', $class->id) }}"
                               class="text-sm font-semibold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl shadow-md hover:opacity-90 transition-all">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
