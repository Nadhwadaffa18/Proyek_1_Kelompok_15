<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4 w-full">
            <h2 class="font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                Jadwal Kelas — {{ $class->name }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            {{-- Form Tambah Jadwal --}}
            <div class="lg:col-span-2">
                <div class="bg-white  rounded-[18px] border border-slate-200/80  shadow-soft overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200/80  bg-slate-50/50 ">
                        <h3 class="font-bold text-slate-800 ">Tambah Jadwal</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Atur hari dan jam kelas</p>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.schedules.store', $class->id) }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-xs font-bold text-slate-500  mb-1.5 uppercase tracking-wide font-mono">Hari</label>
                                <select name="day" required
                                    class="block w-full bg-white text-slate-900  border border-slate-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm">
                                    <option value="" disabled selected>Pilih hari...</option>
                                    @foreach ($days as $day)
                                        <option value="{{ $day }}" {{ old('day') === $day ? 'selected' : '' }}>{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('day')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500  mb-1.5 uppercase tracking-wide font-mono">Jam Mulai</label>
                                    <input type="time" name="start_time" value="{{ old('start_time') }}" required
                                        class="block w-full bg-white text-slate-900  border border-slate-200  focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500  rounded-[12px] shadow-sm py-2 px-3 transition-all text-sm">
                                    @error('start_time')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500  mb-1.5 uppercase tracking-wide font-mono">Jam Selesai</label>
                                    <input type="time" name="end_time" value="{{ old('end_time') }}" required
                                        class="block w-full bg-white text-slate-900  border border-slate-200  focus:border-indigo-500  focus:ring-1 focus:ring-indigo-500  rounded-[12px] shadow-sm py-2 px-3 transition-all text-sm">
                                    @error('end_time')<p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <x-primary-button class="w-full">
                                + Tambah Jadwal
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Daftar Jadwal --}}
            <div class="lg:col-span-3">
                <div class="bg-white  rounded-[18px] border border-slate-200/80  shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200/80  bg-slate-50/50">
                        <h3 class="font-bold text-slate-900 ">
                            Jadwal Aktif
                            <span class="ml-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-indigo-500/10 text-indigo-600 border border-indigo-500/10">
                                {{ $class->schedules->count() }} SESI
                            </span>
                        </h3>
                    </div>
                    <div class="divide-y divide-slate-100 ">
                        @forelse ($class->schedules as $schedule)
                            @php
                                $dayColors = [
                                    'Senin'  => 'bg-blue-500/10 text-blue-600 border-blue-500/10',
                                    'Selasa' => 'bg-purple-500/10 text-purple-600  border-purple-500/10',
                                    'Rabu'   => 'bg-emerald-500/10 text-emerald-600  border-emerald-500/10',
                                    'Kamis'  => 'bg-amber-500/10 text-amber-600  border-amber-500/10',
                                    'Jumat'  => 'bg-rose-500/10 text-rose-600  border-rose-500/10',
                                    'Sabtu'  => 'bg-teal-500/10 text-teal-600  border-teal-500/10',
                                    'Minggu' => 'bg-orange-500/10 text-orange-600  border-orange-500/10',
                                ];
                                $color = $dayColors[$schedule->day] ?? 'bg-slate-500/10 text-slate-600  border-slate-500/10';
                            @endphp
                            <div class="flex items-center justify-between p-5 hover:bg-slate-50/50  transition-colors">
                                <div class="flex items-center gap-4">
                                    <span class="shrink-0 inline-flex items-center justify-center w-20 py-1.5 rounded-lg border text-xs font-bold font-mono {{ $color }}">
                                        {{ $schedule->day }}
                                    </span>
                                    <div>
                                        <p class="font-bold text-slate-900 text-sm font-mono">
                                            {{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}
                                        </p>
                                        <p class="text-[10px] font-semibold mt-1">
                                            @if ($schedule->meeting_link)
                                                <span class="text-emerald-600">✅ Link GMeet sudah diset guru</span>
                                            @else
                                                <span class="text-slate-400  italic font-normal">Belum ada link dari guru</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2.5 shrink-0">
                                    <a href="{{ route('admin.schedules.edit', [$class->id, $schedule->id]) }}"
                                       class="px-3 py-1.5 text-xs font-bold text-indigo-600 bg-indigo-500/10 border border-indigo-500/10 rounded-lg hover:bg-indigo-600 hover:text-white transition-all">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.schedules.destroy', [$class->id, $schedule->id]) }}" method="POST"
                                          onsubmit="return confirm('Hapus jadwal {{ $schedule->day }} {{ substr($schedule->start_time,0,5) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 text-xs font-bold text-rose-600  bg-rose-500/10 border border-rose-500/10 rounded-lg hover:bg-rose-600 hover:text-white transition-all">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-16 text-center">
                                <div class="w-16 h-16 rounded-xl bg-slate-50  border border-slate-100  flex items-center justify-center mx-auto mb-4 text-2xl">
                                    🗓️
                                </div>
                                <p class="text-sm font-bold text-slate-700 ">Belum ada jadwal</p>
                                <p class="text-xs text-slate-400  mt-1.5">Tambahkan jadwal menggunakan form di sebelah kiri.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>