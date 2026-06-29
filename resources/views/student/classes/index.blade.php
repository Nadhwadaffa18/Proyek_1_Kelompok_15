<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            📚 Kelas Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($enrolledClasses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($enrolledClasses as $class)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 flex flex-col justify-between hover:shadow-lg transition-all duration-300 group">
                            <div>
                                {{-- Badge --}}
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300 mb-4">
                                    ✅ Terdaftar
                                </span>

                                {{-- Icon kelas --}}
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center mb-4 shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>

                                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1 leading-tight">{{ $class->name }}</h4>
                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    Guru: <span class="font-semibold text-gray-500 dark:text-gray-400">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                                </p>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('student.classes.show', $class->id) }}"
                                   class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-md shadow-indigo-500/10 active:scale-[0.98]">
                                    Buka Kelas
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty state --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-16 text-center shadow-sm">
                    <div class="w-20 h-20 rounded-2xl bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">Belum Ada Kelas</h3>
                    <p class="text-sm text-gray-400 dark:text-gray-500 max-w-sm mx-auto">
                        Anda belum didaftarkan ke kelas mana pun. Silakan hubungi <strong>Admin</strong> untuk mendaftarkan Anda ke kelas yang sesuai.
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
