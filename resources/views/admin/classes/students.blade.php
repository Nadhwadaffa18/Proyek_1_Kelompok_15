<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight flex items-center gap-2">
                    Kelola Siswa Kelas — {{ $class->name }}
                </h2>
                <p class="text-xs font-semibold font-mono text-slate-400 uppercase tracking-wider mt-1.5">
                    Guru Pengampu: <span class="text-indigo-600 dark:text-indigo-400 font-bold">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                </p>
            </div>
            <a href="{{ route('admin.classes.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Alert Messages -->
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Card Tambah Siswa ke Kelas -->
            <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft p-6 h-fit">
                <h3 class="text-base font-bold text-slate-800 dark:text-white mb-4">Tambahkan Siswa</h3>
                
                @if ($availableStudents->count() > 0)
                    <form action="{{ route('admin.classes.students.add', $class->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide font-mono">Pilih Siswa</label>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mb-3">Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu siswa.</p>
                            <select name="student_ids[]" multiple required class="block w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2 px-3 transition-all text-sm h-60">
                                @foreach ($availableStudents as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                                @endforeach
                            </select>
                            @error('student_ids')
                                <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                        <x-primary-button class="w-full">
                            Masukkan ke Kelas
                        </x-primary-button>
                    </form>
                @else
                    <div class="p-6 text-center text-slate-400 dark:text-slate-500 border border-dashed border-slate-200 dark:border-slate-800 rounded-xl text-sm">
                        Semua siswa terdaftar sudah dimasukkan ke dalam kelas ini.
                    </div>
                @endif
            </div>

            <!-- Daftar Siswa yang Terdaftar di Kelas -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200/80 dark:border-slate-800/80 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-bold text-slate-900 dark:text-white">
                        Siswa Terdaftar
                    </h3>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold font-mono bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/10">
                        {{ $class->students->count() }} SISWA
                    </span>
                </div>

                <div class="divide-y divide-slate-100 dark:divide-slate-800/60">
                    @forelse ($class->students as $student)
                        <div class="flex items-center justify-between p-5 hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm border border-indigo-500/15 uppercase">
                                    {{ substr($student->name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-slate-900 dark:text-white">{{ $student->name }}</h4>
                                    <p class="text-xs text-slate-400 font-mono mt-0.5">{{ $student->email }}</p>
                                </div>
                            </div>
                            <form action="{{ route('admin.classes.students.remove', [$class->id, $student->id]) }}" method="POST" onsubmit="return confirm('Keluarkan {{ $student->name }} dari kelas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-rose-600 dark:text-rose-400 bg-rose-500/10 border border-rose-500/10 rounded-lg hover:bg-rose-600 hover:text-white transition-all">
                                    Keluarkan
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="p-16 text-center">
                            <div class="w-16 h-16 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-300">Belum ada siswa di kelas ini</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1.5">Tambahkan siswa menggunakan form di sebelah kiri.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
