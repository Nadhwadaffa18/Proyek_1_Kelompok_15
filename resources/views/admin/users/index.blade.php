<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full gap-4">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ __('Kelola Pengguna') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="flex-shrink-0 inline-flex items-center whitespace-nowrap px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold rounded-xl text-white shadow-sm hover:shadow active:scale-[0.98] transition-all duration-150">
                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Alert Messages -->
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 dark:border-slate-800/80 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                                <th class="pb-4">Nama</th>
                                <th class="pb-4">Email</th>
                                <th class="pb-4">Role</th>
                                <th class="pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-sm text-slate-600 dark:text-slate-300">
                            @forelse ($users as $user)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors duration-150">
                                    <td class="py-4 font-semibold text-slate-900 dark:text-white">{{ $user->name }}</td>
                                    <td class="py-4 font-mono text-xs">{{ $user->email }}</td>
                                    <td class="py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono uppercase tracking-wider
                                            @if($user->role === 'admin') bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10
                                            @elseif($user->role === 'guru') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/10
                                            @else bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/10
                                            @endif">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-right space-x-3">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                            Edit
                                        </a>
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="inline-flex items-center text-sm font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-slate-400 dark:text-slate-500">Belum ada pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
