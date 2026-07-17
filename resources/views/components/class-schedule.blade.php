{{-- Komponen: Jadwal Kelas (read-only untuk siswa, atau guru yg sudah ada link) --}}
@if ($class->schedules->count() > 0)
<div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 shadow-soft overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
        <h3 class="font-display font-bold text-slate-900">Jadwal Kelas</h3>
        @if (auth()->user()->role === 'guru')
            <a href="{{ route('teacher.schedules.index', $class->id) }}"
               class="text-xs font-bold text-primary hover:underline transition-all">
                Atur Link GMeet
            </a>
        @endif
    </div>
    <div class="divide-y divide-slate-100">
        @php
            $dayColors = [
                'Senin'  => 'bg-blue-500/10 text-blue-600 border border-blue-500/10',
                'Selasa' => 'bg-purple-500/10 text-purple-600 border border-purple-500/10',
                'Rabu'   => 'bg-emerald-500/10 text-emerald-600 border border-emerald-500/10',
                'Kamis'  => 'bg-amber-500/10 text-amber-600 border border-amber-500/10',
                'Jumat'  => 'bg-rose-500/10 text-rose-600 border border-rose-500/10',
                'Sabtu'  => 'bg-teal-500/10 text-teal-600 border border-teal-500/10',
                'Minggu' => 'bg-orange-500/10 text-orange-600 border border-orange-500/10',
            ];
        @endphp
        @foreach ($class->schedules as $schedule)
            @php $color = $dayColors[$schedule->day] ?? 'bg-slate-500/10 text-slate-600'; @endphp
            <div class="flex items-center gap-4 px-6 py-4">
                <span class="shrink-0 inline-flex items-center justify-center w-20 py-1.5 rounded-lg text-xs font-bold {{ $color }}">
                    {{ $schedule->day }}
                </span>
                <div class="flex-grow">
                    <p class="text-sm font-bold text-slate-900 font-mono">
                        {{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}
                    </p>
                    @if (!$schedule->meeting_link)
                        <p class="text-xs text-slate-400 mt-0.5 italic font-normal">Link belum tersedia</p>
                    @endif
                </div>
                {{-- Tombol Masuk Kelas --}}
                @if ($schedule->meeting_link)
                    <a href="{{ $schedule->meeting_link }}" target="_blank" rel="noopener noreferrer"
                       class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-550 text-white text-xs font-bold rounded-xl shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
                        <i class="fa-solid fa-video text-xs"></i>
                        Masuk
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif
