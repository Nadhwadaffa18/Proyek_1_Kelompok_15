<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert Success -->
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistical Grid (Responsive 4/2/1) -->
        <!-- Statistical Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Total Pengguna -->
    <div class="bg-white rounded-card border border-primary/60 p-6">
        <div class="flex items-start justify-between">
            <h3 class="text-lg font-semibold text-slate-900">Total Pengguna</h3>

            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                <i class="fa-solid fa-user text-primary text-xl"></i>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                {{ $stats['users'] }}
            </h2>

            <div class="flex items-center gap-2 mt-4">
                <span class="text-sm text-slate-500">Pengguna terdaftar</span>
            </div>
        </div>
    </div>

    <!-- Total Guru -->
    <div class="bg-white rounded-card border border-primary/60 p-6">
        <div class="flex items-start justify-between">
            <h3 class="text-lg font-semibold text-slate-900">Total Guru</h3>

            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                <i class="fa-solid fa-graduation-cap text-primary text-xl"></i>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                {{ $stats['teachers'] }}
            </h2>

            <div class="flex items-center gap-2 mt-4">
                <span class="text-sm text-slate-500">Guru terdaftar</span>
            </div>
        </div>
    </div>

    <!-- Total Siswa -->
    <div class="bg-white rounded-card border border-primary/60 p-6">
        <div class="flex items-start justify-between">
            <h3 class="text-lg font-semibold text-slate-900">Total Siswa</h3>

            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                <i class="fa-solid fa-user-group text-primary text-xl"></i>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                {{ $stats['students'] }}
            </h2>

            <div class="flex items-center gap-2 mt-4">
                <span class="text-sm text-slate-500">Siswa terdaftar</span>
            </div>
        </div>
    </div>

    <!-- Total Kelas -->
    <div class="bg-white rounded-card border border-primary/60 p-6">
        <div class="flex items-start justify-between">
            <h3 class="text-lg font-semibold text-slate-900">Total Kelas</h3>

            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                <i class="fa-solid fa-table-columns text-primary text-xl"></i>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-5xl font-bold tracking-tight text-slate-900">
                {{ $stats['classes'] }}
            </h2>

            <div class="flex items-center gap-2 mt-4">
                <span class="text-sm text-slate-500">Kelas aktif</span>
            </div>
        </div>
    </div>

</div>

        <!-- Two Column Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Users -->
            <div class="bg-white rounded-card border border-black/15 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h4 class="text-base font-bold text-slate-850 font-display">Pengguna Terbaru</h4>
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-primary hover:text-secondary flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="pb-3">Nama</th>
                                    <th class="pb-3">Email</th>
                                    <th class="pb-3 text-right">Role</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="py-3.5 font-bold text-slate-900 font-display">{{ $user->name }}</td>
                                        <td class="py-3.5">{{ $user->email }}</td>
                                        <td class="py-3.5 text-right">
                                            <span
    class="inline-flex min-w-[80px] justify-center items-center rounded-full px-3 py-1 text-[11px] font-semibold capitalize
    @if($user->role === 'admin') text-primary border border-primary
    @elseif($user->role === 'guru') text-emerald-600 border border-emerald-600
    @else text-amber-600 border border-amber-600
    @endif">
    {{ $user->role }}
</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-slate-400">Belum ada pengguna.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Classes -->
            <div class="bg-white rounded-card border border-black/15 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h4 class="text-base font-bold text-slate-850 font-display">Kelas Terbaru</h4>
                    <a href="{{ route('admin.classes.index') }}" class="text-xs font-bold text-primary hover:text-secondary flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="pb-3">Nama Kelas</th>
                                    <th class="pb-3">Guru Pengampu</th>
                                    <th class="pb-3 text-right">Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                                @forelse ($classes as $class)
                                    <tr>
                                        <td class="py-3.5 font-bold text-slate-900 font-display">{{ $class->name }}</td>
                                        <td class="py-3.5">
                                            @if($class->teacher)
                                                <span class="font-semibold text-slate-700">{{ $class->teacher->name }}</span>
                                            @else
                                                <span class="text-slate-400 italic">Belum Ditentukan</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 text-right font-mono text-slate-450">{{ $class->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-slate-400">Belum ada kelas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
