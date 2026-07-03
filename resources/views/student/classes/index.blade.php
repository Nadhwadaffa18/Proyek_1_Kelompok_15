<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            📚 Kelas Saya
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if ($enrolledClasses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($enrolledClasses as $class)
                    <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 flex flex-col justify-between hover:shadow-soft-lg hover:border-indigo-500/20 transition-all duration-300 group">
                        <div>
                            {{-- Badge --}}
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/10 mb-4">
                                JOINED
                            </span>

                            {{-- Icon kelas --}}
                            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-4 border border-indigo-500/15 group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>

                            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-1.5 leading-tight tracking-tight">{{ $class->name }}</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                Guru: <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                            </p>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('student.classes.show', $class->id) }}"
                               class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl transition-all shadow-sm active:scale-[0.98] group">
                                Buka Kelas
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty state --}}
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 p-16 text-center shadow-soft">
                <div class="w-16 h-16 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/15 flex items-center justify-center mx-auto mb-5 text-2xl">
                    📚
                </div>
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Belum Ada Kelas</h3>
                <p class="text-xs text-slate-400 dark:text-slate-500 max-w-sm mx-auto leading-relaxed">
                    Anda belum didaftarkan ke kelas mana pun. Silakan hubungi <strong class="font-bold">Admin</strong> untuk mendaftarkan Anda ke kelas yang sesuai.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>
