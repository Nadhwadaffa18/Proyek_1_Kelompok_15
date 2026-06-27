<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kelas & Gabung') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Kelas Tersedia untuk Digabung -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Kelas yang Bisa Diikuti</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($availableClasses as $class)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $class->name }}</h4>
                                <p class="text-xs text-gray-400">Guru: {{ $class->teacher->name ?? 'Belum Ditentukan' }}</p>
                            </div>
                            <div class="mt-6">
                                <form action="{{ route('student.classes.join') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="class_id" value="{{ $class->id }}">
                                    <button type="submit" class="w-full py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-xs font-semibold rounded-xl hover:opacity-90 transition-all shadow-md shadow-indigo-500/10 active:scale-[0.98]">
                                        Gabung Kelas
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 text-center text-gray-400 border border-gray-100 dark:border-gray-700 col-span-3 text-sm">
                            Tidak ada kelas lain yang tersedia untuk diikuti saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Kelas yang Sudah Diikuti -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 font-semibold">Kelas Saya</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($joinedClasses as $class)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 mb-4">Terdaftar</span>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $class->name }}</h4>
                                <p class="text-xs text-gray-400">Guru: {{ $class->teacher->name ?? 'Belum Ditentukan' }}</p>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('student.classes.show', $class->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                    Buka Kelas
                                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 text-center text-gray-400 border border-gray-100 dark:border-gray-700 col-span-3 text-sm">
                            Anda belum bergabung ke kelas mana pun.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
