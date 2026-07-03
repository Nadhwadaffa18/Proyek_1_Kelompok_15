<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full gap-4">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                Edit Jadwal — {{ $class->name }}
            </h2>
            <a href="{{ route('admin.schedules.index', $class->id) }}" class="inline-flex items-center whitespace-nowrap text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-md mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                    Hanya <strong class="font-bold text-slate-800 dark:text-slate-200">hari & waktu</strong> yang dapat diubah di sini. Link pertemuan diatur oleh guru.
                </p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.schedules.update', [$class->id, $schedule->id]) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide font-mono">Hari</label>
                        <select name="day" required
                            class="block w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm">
                            @foreach ($days as $day)
                                <option value="{{ $day }}" {{ old('day', $schedule->day) === $day ? 'selected' : '' }}>{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('day')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide font-mono">Jam Mulai</label>
                            <input type="time" name="start_time" value="{{ old('start_time', substr($schedule->start_time, 0, 5)) }}" required
                                class="block w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3 transition-all text-sm">
                            @error('start_time')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide font-mono">Jam Selesai</label>
                            <input type="time" name="end_time" value="{{ old('end_time', substr($schedule->end_time, 0, 5)) }}" required
                                class="block w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3 transition-all text-sm">
                            @error('end_time')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <a href="{{ route('admin.schedules.index', $class->id) }}"
                           class="text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Simpan Perubahan
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
