{{-- Komponen: Jadwal Kelas (read-only untuk siswa, atau guru yg sudah ada link) --}}
@if ($class->schedules->count() > 0)
<div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50 flex items-center justify-between">
        <h3 class="font-bold text-slate-900 dark:text-white">Jadwal Kelas</h3>
        @if (auth()->user()->role === 'guru')
            <a href="{{ route('teacher.schedules.index', $class->id) }}"
               class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline transition-all">
                Atur Link GMeet
            </a>
        @endif
    </div>
    <div class="divide-y divide-slate-100 dark:divide-slate-800/60">
        @php
            $dayColors = [
                'Senin'  => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/10',
                'Selasa' => 'bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/10',
                'Rabu'   => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/10',
                'Kamis'  => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/10',
                'Jumat'  => 'bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/10',
                'Sabtu'  => 'bg-teal-500/10 text-teal-600 dark:text-teal-400 border border-teal-500/10',
                'Minggu' => 'bg-orange-500/10 text-orange-600 dark:text-orange-400 border border-orange-500/10',
            ];
        @endphp
        @foreach ($class->schedules as $schedule)
            @php $color = $dayColors[$schedule->day] ?? 'bg-slate-500/10 text-slate-600 dark:text-slate-400'; @endphp
            <div class="flex items-center gap-4 px-6 py-4">
                <span class="shrink-0 inline-flex items-center justify-center w-20 py-1.5 rounded-lg text-xs font-bold font-mono {{ $color }}">
                    {{ $schedule->day }}
                </span>
                <div class="flex-grow">
                    <p class="text-sm font-bold text-slate-900 dark:text-white font-mono">
                        {{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}
                    </p>
                    @if (!$schedule->meeting_link)
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 italic font-normal">Link belum tersedia</p>
                    @endif
                </div>
                {{-- Tombol Masuk Kelas --}}
                @if ($schedule->meeting_link)
                    <a href="{{ $schedule->meeting_link }}" target="_blank" rel="noopener noreferrer"
                       class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow active:scale-[0.98] transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.677v6.646a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                        </svg>
                        Masuk
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif
