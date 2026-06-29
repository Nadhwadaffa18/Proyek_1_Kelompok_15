<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    🔗 Link Pertemuan — {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Perbarui link Google Meet setiap kali ada pertemuan baru
                </p>
            </div>
            <a href="{{ route('teacher.dashboard') }}"
               class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl text-sm font-medium">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Info box --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-xl px-5 py-4 text-sm text-blue-700 dark:text-blue-300">
                <strong>💡 Cara pakai:</strong> Sebelum kelas dimulai, buat link Google Meet baru lalu tempel di kolom jadwal yang sesuai. Siswa akan langsung melihat tombol <strong>Masuk Kelas</strong> di halaman kelas mereka.
            </div>

            {{-- Daftar jadwal + form link --}}
            @forelse ($class->schedules as $schedule)
                @php
                    $dayColors = [
                        'Senin'  => 'from-blue-500 to-blue-600',
                        'Selasa' => 'from-purple-500 to-purple-600',
                        'Rabu'   => 'from-emerald-500 to-emerald-600',
                        'Kamis'  => 'from-amber-500 to-amber-600',
                        'Jumat'  => 'from-rose-500 to-rose-600',
                        'Sabtu'  => 'from-teal-500 to-teal-600',
                        'Minggu' => 'from-orange-500 to-orange-600',
                    ];
                    $grad = $dayColors[$schedule->day] ?? 'from-gray-500 to-gray-600';
                @endphp

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    {{-- Header jadwal --}}
                    <div class="flex items-center gap-4 px-6 py-4 bg-gradient-to-r {{ $grad }} text-white">
                        <div class="shrink-0 w-12 h-12 rounded-xl bg-white/20 flex flex-col items-center justify-center leading-none">
                            <span class="text-[10px] font-semibold opacity-80">{{ strtoupper(substr($schedule->day, 0, 3)) }}</span>
                            <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg leading-tight">{{ $schedule->day }}</p>
                            <p class="text-sm text-white/80">{{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}</p>
                        </div>
                        @if ($schedule->meeting_link)
                            <a href="{{ $schedule->meeting_link }}" target="_blank"
                               class="ml-auto inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white text-sm font-semibold rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Buka Link
                            </a>
                        @endif
                    </div>

                    {{-- Form update link --}}
                    <div class="p-6">
                        <form action="{{ route('teacher.schedules.updateLink', [$class->id, $schedule->id]) }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PATCH')
                            <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">
                                Link Google Meet untuk Pertemuan Ini
                            </label>
                            <div class="flex gap-3">
                                <input type="url" name="meeting_link"
                                    value="{{ old('meeting_link', $schedule->meeting_link) }}"
                                    placeholder="https://meet.google.com/xxx-xxxx-xxx"
                                    class="flex-1 border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                                <button type="submit"
                                    class="shrink-0 px-4 py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl shadow-md hover:opacity-90 transition-all">
                                    Simpan
                                </button>
                            </div>
                            @if ($schedule->meeting_link)
                                <p class="text-xs text-emerald-600 dark:text-emerald-400">
                                    ✅ Link aktif — siswa sudah bisa melihat tombol "Masuk Kelas"
                                </p>
                            @else
                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    Belum ada link. Isi link GMeet sebelum kelas dimulai.
                                </p>
                            @endif
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-12 text-center">
                    <div class="text-5xl mb-4">🗓️</div>
                    <p class="font-semibold text-gray-700 dark:text-gray-300">Belum ada jadwal</p>
                    <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Admin belum mengatur jadwal untuk kelas ini.</p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
