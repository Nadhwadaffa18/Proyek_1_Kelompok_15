<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            Kelas Saya
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if ($enrolledClasses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($enrolledClasses as $class)
                    <div class="bg-white rounded-card border border-white/45 shadow-soft p-6 flex flex-col justify-between hover:scale-[1.03] hover:shadow-soft-lg transition-all duration-300 group">
                        <div>
                            {{-- Badge --}}
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 border border-emerald-500/10 mb-4">
                                JOINED
                            </span>

                            {{-- Icon kelas --}}
                            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-4 border border-primary/15 group-hover:scale-105 transition-transform duration-300">
                                <i class="fa-solid fa-graduation-cap text-lg"></i>
                            </div>

                            <h4 class="text-lg font-bold text-slate-900 mb-1.5 leading-tight tracking-tight font-display">{{ $class->name }}</h4>
                            <p class="text-xs text-slate-500">
                                Guru: <span class="font-semibold text-slate-700">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                            </p>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('student.classes.show', $class->id) }}"
                               class="w-full inline-flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-primary to-secondary text-white text-sm font-semibold rounded-[14px] shadow-sm hover:opacity-95 active:scale-[0.98] transition-all group">
                                Buka Kelas
                                <i class="fa-solid fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty state --}}
            <div class="bg-white/72 backdrop-blur-[18px] rounded-card border border-white/45 p-16 text-center shadow-soft">
                <div class="w-16 h-16 rounded-xl bg-primary/10 text-primary border border-primary/15 flex items-center justify-center mx-auto mb-5 text-2xl">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2 font-display">Belum Ada Kelas</h3>
                <p class="text-xs text-slate-400 max-w-sm mx-auto leading-relaxed">
                    Anda belum didaftarkan ke kelas mana pun. Silakan hubungi <strong class="font-bold text-slate-700">Admin</strong> untuk mendaftarkan Anda ke kelas yang sesuai.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>
