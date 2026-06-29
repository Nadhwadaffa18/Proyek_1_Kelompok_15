{{-- Komponen: Jadwal Kelas (read-only untuk siswa, atau guru yg sudah ada link) --}}
@if ($class->schedules->count() > 0)
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center justify-between">
        <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">🗓️ Jadwal Kelas</h3>
        @if (auth()->user()->role === 'guru')
            <a href="{{ route('teacher.schedules.index', $class->id) }}"
               class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-colors">
                ✏️ Atur Link GMeet
            </a>
        @endif
    </div>
    <div class="divide-y divide-gray-100 dark:divide-gray-700">
        @php
            $dayColors = [
                'Senin'  => 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700',
                'Selasa' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-700',
                'Rabu'   => 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700',
                'Kamis'  => 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-700',
                'Jumat'  => 'bg-rose-50 dark:bg-rose-900/20 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-700',
                'Sabtu'  => 'bg-teal-50 dark:bg-teal-900/20 text-teal-700 dark:text-teal-300 border border-teal-200 dark:border-teal-700',
                'Minggu' => 'bg-orange-50 dark:bg-orange-900/20 text-orange-700 dark:text-orange-300 border border-orange-200 dark:border-orange-700',
            ];
        @endphp
        @foreach ($class->schedules as $schedule)
            @php $color = $dayColors[$schedule->day] ?? 'bg-gray-100 text-gray-600'; @endphp
            <div class="flex items-center gap-4 px-6 py-4">
                <span class="shrink-0 inline-flex items-center justify-center w-20 py-1.5 rounded-lg text-xs font-bold {{ $color }}">
                    {{ $schedule->day }}
                </span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        {{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}
                    </p>
                    @if (!$schedule->meeting_link)
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 italic">Link belum tersedia</p>
                    @endif
                </div>
                {{-- Tombol Masuk Kelas --}}
                @if ($schedule->meeting_link)
                    <a href="{{ $schedule->meeting_link }}" target="_blank" rel="noopener noreferrer"
                       class="shrink-0 inline-flex items-center gap-1.5 px-3 py-2 bg-gradient-to-r from-emerald-500 to-green-600 text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-500/20 hover:opacity-90 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.677v6.646a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                        </svg>
                        Masuk Kelas
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif
