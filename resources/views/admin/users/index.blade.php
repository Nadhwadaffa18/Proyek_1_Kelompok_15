<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Pengguna') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-sm font-semibold rounded-xl text-white shadow-md shadow-indigo-500/10 hover:opacity-90 transform active:scale-[0.98] transition-all">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-700 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <th class="pb-4">Nama</th>
                                    <th class="pb-4">Email</th>
                                    <th class="pb-4">Role</th>
                                    <th class="pb-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors duration-200">
                                        <td class="py-4 font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                        <td class="py-4">{{ $user->email }}</td>
                                        <td class="py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize 
                                                @if($user->role === 'admin') bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300
                                                @elseif($user->role === 'guru') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300
                                                @else bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300
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
                                        <td colspan="4" class="py-8 text-center text-gray-400">Belum ada pengguna.</td>
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
    </div>
</x-app-layout>
