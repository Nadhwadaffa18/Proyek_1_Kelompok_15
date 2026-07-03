<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                    🔗 Link Pertemuan — {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">
                    Perbarui link Google Meet setiap kali ada pertemuan baru
                </p>
            </div>
            <a href="{{ route('teacher.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Info box --}}
        <div class="bg-blue-500/5 border border-blue-500/10 rounded-xl px-5 py-4 text-sm text-blue-700 dark:text-blue-400 flex items-start gap-3">
            <svg class="w-5 h-5 shrink-0 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <strong class="font-bold">Cara pakai:</strong> Sebelum kelas dimulai, buat link Google Meet baru lalu tempel di kolom jadwal yang sesuai. Siswa akan langsung melihat tombol <span class="font-semibold text-slate-800 dark:text-slate-200">Masuk Kelas</span> di halaman kelas mereka.
            </div>
        </div>

        {{-- Daftar jadwal + form link --}}
        @forelse ($class->schedules as $schedule)
            @php
                $dayColors = [
                    'Senin'  => 'from-blue-500 to-indigo-600',
                    'Selasa' => 'from-purple-500 to-indigo-600',
                    'Rabu'   => 'from-emerald-500 to-teal-600',
                    'Kamis'  => 'from-amber-500 to-orange-600',
                    'Jumat'  => 'from-rose-500 to-pink-600',
                    'Sabtu'  => 'from-teal-500 to-indigo-600',
                    'Minggu' => 'from-orange-500 to-red-600',
                ];
                $grad = $dayColors[$schedule->day] ?? 'from-slate-500 to-slate-600';
            @endphp

            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                {{-- Header jadwal --}}
                <div class="flex items-center gap-4 px-6 py-5 bg-gradient-to-r {{ $grad }} text-white">
                    <div class="shrink-0 w-12 h-12 rounded-xl bg-white/20 flex flex-col items-center justify-center leading-none">
                        <span class="text-[9px] font-bold opacity-90 font-mono">{{ strtoupper(substr($schedule->day, 0, 3)) }}</span>
                        <svg class="w-4.5 h-4.5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-extrabold text-lg leading-tight tracking-tight">{{ $schedule->day }}</p>
                        <p class="text-xs text-white/80 font-mono mt-0.5">{{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}</p>
                    </div>
                    @if ($schedule->meeting_link)
                        <a href="{{ $schedule->meeting_link }}" target="_blank"
                           class="ml-auto inline-flex items-center gap-1.5 px-3.5 py-2 bg-white/20 hover:bg-white/30 text-white text-xs font-bold rounded-xl transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide font-mono mb-1">
                            Link Google Meet untuk Pertemuan Ini
                        </label>
                        <div class="flex gap-3">
                            <input type="url" name="meeting_link"
                                value="{{ old('meeting_link', $schedule->meeting_link) }}"
                                placeholder="https://meet.google.com/xxx-xxxx-xxx"
                                class="flex-grow bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3.5 transition-all text-sm outline-none" required>
                            <x-primary-button class="shrink-0 py-2.5">
                                Simpan
                            </x-primary-button>
                        </div>
                        @if ($schedule->meeting_link)
                            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Link aktif — siswa sudah bisa melihat tombol "Masuk Kelas"
                            </p>
                        @else
                            <p class="text-xs text-slate-400 dark:text-slate-500 italic">
                                Belum ada link. Isi link GMeet sebelum kelas dimulai.
                            </p>
                        @endif
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 p-16 text-center shadow-soft">
                <div class="w-16 h-16 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-center justify-center mx-auto mb-4 text-2xl">
                    🗓️
                </div>
                <p class="font-bold text-slate-700 dark:text-slate-300">Belum ada jadwal</p>
                <p class="text-xs text-slate-400 dark:text-slate-500 mt-1.5">Admin belum mengatur jadwal untuk kelas ini.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
