<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert Success -->
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistical Grid (Responsive 4/2/1) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['users'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Total Pengguna</p>
                </div>
            </div>

            <!-- Total Teachers -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold flex items-center justify-center border border-emerald-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['teachers'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Total Guru</p>
                </div>
            </div>

            <!-- Total Students -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 font-bold flex items-center justify-center border border-amber-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['students'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Total Siswa</p>
                </div>
            </div>

            <!-- Total Classes -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 hover:shadow-soft-lg transition-all duration-300">
                <div class="flex flex-col">
                    <div class="w-12 h-12 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 font-bold flex items-center justify-center border border-rose-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-4">{{ $stats['classes'] }}</h3>
                    <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">Total Kelas</p>
                </div>
            </div>
        </div>

        <!-- Two Column Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Users -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                    <h4 class="text-base font-bold text-slate-800 dark:text-slate-100">Pengguna Terbaru</h4>
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-800/80 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                    <th class="pb-3">Nama</th>
                                    <th class="pb-3">Email</th>
                                    <th class="pb-3 text-right">Role</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="py-3.5 font-semibold text-slate-900 dark:text-white">{{ $user->name }}</td>
                                        <td class="py-3.5">{{ $user->email }}</td>
                                        <td class="py-3.5 text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono uppercase tracking-wider
                                                @if($user->role === 'admin') bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10
                                                @elseif($user->role === 'guru') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/10
                                                @else bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/10
                                                @endif">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-slate-400 dark:text-slate-500">Belum ada pengguna.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Classes -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                    <h4 class="text-base font-bold text-slate-800 dark:text-slate-100">Kelas Terbaru</h4>
                    <a href="{{ route('admin.classes.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-800/80 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                                    <th class="pb-3">Nama Kelas</th>
                                    <th class="pb-3">Guru Pengampu</th>
                                    <th class="pb-3 text-right">Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                                @forelse ($classes as $class)
                                    <tr>
                                        <td class="py-3.5 font-semibold text-slate-900 dark:text-white">{{ $class->name }}</td>
                                        <td class="py-3.5">
                                            @if($class->teacher)
                                                <span class="font-medium text-slate-700 dark:text-slate-200">{{ $class->teacher->name }}</span>
                                            @else
                                                <span class="text-slate-400 dark:text-slate-500 italic">Belum Ditentukan</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 text-right font-mono text-slate-400 dark:text-slate-500">{{ $class->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-slate-400 dark:text-slate-500">Belum ada kelas.</td>
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
