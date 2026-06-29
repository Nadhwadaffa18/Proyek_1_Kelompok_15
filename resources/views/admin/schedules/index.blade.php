<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    🗓️ Jadwal Kelas — {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Guru: {{ $class->teacher->name ?? 'Belum ditentukan' }} &nbsp;·&nbsp;
                    <span class="text-indigo-500 dark:text-indigo-400">Link GMeet diatur oleh guru</span>
                </p>
            </div>
            <a href="{{ route('admin.classes.index') }}"
               class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kelola Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl text-sm font-medium">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Info box --}}
            <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-700 rounded-xl px-5 py-4 text-sm text-indigo-700 dark:text-indigo-300">
                <strong>📌 Pembagian Tugas:</strong>
                Admin mengatur <strong>hari & waktu</strong> kelas. Guru mengatur <strong>link Google Meet</strong> setiap pertemuan secara mandiri.
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

                {{-- Form Tambah Jadwal (Admin — hari & jam saja) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-gray-900 dark:text-gray-100">Tambah Jadwal</h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Atur hari dan jam kelas</p>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.schedules.store', $class->id) }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Hari</label>
                                    <select name="day" required
                                        class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                                        <option value="" disabled selected>Pilih hari...</option>
                                        @foreach ($days as $day)
                                            <option value="{{ $day }}" {{ old('day') === $day ? 'selected' : '' }}>{{ $day }}</option>
                                        @endforeach
                                    </select>
                                    @error('day')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Jam Mulai</label>
                                        <input type="time" name="start_time" value="{{ old('start_time') }}" required
                                            class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                        @error('start_time')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Jam Selesai</label>
                                        <input type="time" name="end_time" value="{{ old('end_time') }}" required
                                            class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                                        @error('end_time')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 hover:opacity-90 transition-all">
                                    + Tambah Jadwal
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Daftar Jadwal --}}
                <div class="lg:col-span-3">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                            <h3 class="font-bold text-gray-900 dark:text-gray-100">
                                Jadwal Aktif
                                <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400">
                                    {{ $class->schedules->count() }} sesi
                                </span>
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($class->schedules as $schedule)
                                @php
                                    $dayColors = [
                                        'Senin'  => 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border-blue-200 dark:border-blue-700',
                                        'Selasa' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 border-purple-200 dark:border-purple-700',
                                        'Rabu'   => 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700',
                                        'Kamis'  => 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 border-amber-200 dark:border-amber-700',
                                        'Jumat'  => 'bg-rose-50 dark:bg-rose-900/20 text-rose-700 dark:text-rose-300 border-rose-200 dark:border-rose-700',
                                        'Sabtu'  => 'bg-teal-50 dark:bg-teal-900/20 text-teal-700 dark:text-teal-300 border-teal-200 dark:border-teal-700',
                                        'Minggu' => 'bg-orange-50 dark:bg-orange-900/20 text-orange-700 dark:text-orange-300 border-orange-200 dark:border-orange-700',
                                    ];
                                    $color = $dayColors[$schedule->day] ?? 'bg-gray-50 text-gray-600 border-gray-200';
                                @endphp
                                <div class="flex items-center justify-between p-5 hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <span class="shrink-0 inline-flex items-center justify-center w-20 py-1.5 rounded-lg border text-xs font-bold {{ $color }}">
                                            {{ $schedule->day }}
                                        </span>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-gray-100 text-sm">
                                                {{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}
                                            </p>
                                            <p class="text-xs mt-0.5">
                                                @if ($schedule->meeting_link)
                                                    <span class="text-emerald-600 dark:text-emerald-400 font-medium">✅ Link GMeet sudah diset guru</span>
                                                @else
                                                    <span class="text-gray-400 dark:text-gray-500 italic">Belum ada link dari guru</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <a href="{{ route('admin.schedules.edit', [$class->id, $schedule->id]) }}"
                                           class="px-3 py-1.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 transition-colors">
                                            Edit Jadwal
                                        </a>
                                        <form action="{{ route('admin.schedules.destroy', [$class->id, $schedule->id]) }}" method="POST"
                                              onsubmit="return confirm('Hapus jadwal {{ $schedule->day }} {{ substr($schedule->start_time,0,5) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-900/30 rounded-lg hover:bg-rose-100 transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center">
                                    <div class="text-4xl mb-3">🗓️</div>
                                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Belum ada jadwal</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Tambahkan jadwal menggunakan form di sebelah kiri.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
