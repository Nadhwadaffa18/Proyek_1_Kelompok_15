<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Alert Success -->
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistical Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Users -->
                <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl shadow-lg shadow-indigo-500/10 p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium uppercase tracking-wider">Total Pengguna</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['users'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Teachers -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-lg shadow-emerald-500/10 p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm font-medium uppercase tracking-wider">Total Guru</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['teachers'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Students -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-lg shadow-amber-500/10 p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-sm font-medium uppercase tracking-wider">Total Siswa</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['students'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Classes -->
                <div class="bg-gradient-to-br from-rose-500 to-pink-600 rounded-2xl shadow-lg shadow-rose-500/10 p-6 text-white transform hover:scale-[1.02] transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-rose-100 text-sm font-medium uppercase tracking-wider">Total Kelas</p>
                            <h3 class="text-4xl font-bold mt-2">{{ $stats['classes'] }}</h3>
                        </div>
                        <div class="bg-white/10 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Users -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pengguna Terbaru</h4>
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300">Lihat Semua</a>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        <th class="pb-3">Nama</th>
                                        <th class="pb-3">Email</th>
                                        <th class="pb-3">Role</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                                    @forelse ($users as $user)
                                        <tr>
                                            <td class="py-3 font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                            <td class="py-3">{{ $user->email }}</td>
                                            <td class="py-3">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize 
                                                    @if($user->role === 'admin') bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300
                                                    @elseif($user->role === 'guru') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300
                                                    @else bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300
                                                    @endif">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 text-center text-gray-400">Belum ada pengguna.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Classes -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Kelas Terbaru</h4>
                        <a href="{{ route('admin.classes.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300">Lihat Semua</a>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        <th class="pb-3">Nama Kelas</th>
                                        <th class="pb-3">Guru Pengampu</th>
                                        <th class="pb-3">Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                                    @forelse ($classes as $class)
                                        <tr>
                                            <td class="py-3 font-medium text-gray-900 dark:text-gray-100">{{ $class->name }}</td>
                                            <td class="py-3">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</td>
                                            <td class="py-3">{{ $class->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 text-center text-gray-400">Belum ada kelas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
