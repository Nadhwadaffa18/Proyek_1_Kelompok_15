<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    🧑‍🎓 Kelola Siswa Kelas — {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Guru Pengampu: <span class="font-semibold">{{ $class->teacher->name ?? 'Belum Ditentukan' }}</span>
                </p>
            </div>
            <a href="{{ route('admin.classes.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Card Tambah Siswa ke Kelas -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6 h-fit">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Tambahkan Siswa</h3>
                    
                    @if ($availableStudents->count() > 0)
                        <form action="{{ route('admin.classes.students.add', $class->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 uppercase tracking-wide">Pilih Siswa</label>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mb-3">Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu siswa.</p>
                                <select name="student_ids[]" multiple required class="block w-full border border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all h-60">
                                    @foreach ($availableStudents as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                                    @endforeach
                                </select>
                                @error('student_ids')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-md shadow-indigo-500/10 active:scale-[0.98]">
                                Masukkan ke Kelas
                            </button>
                        </form>
                    @else
                        <div class="p-6 text-center text-gray-400 dark:text-gray-500 border border-dashed border-gray-200 dark:border-gray-700 rounded-xl text-sm">
                            Semua siswa terdaftar sudah dimasukkan ke dalam kelas ini.
                        </div>
                    @endif
                </div>

                <!-- Daftar Siswa yang Terdaftar di Kelas -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                        <h3 class="font-bold text-gray-900 dark:text-gray-100">
                            Siswa Terdaftar
                        </h3>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400">
                            {{ $class->students->count() }} siswa
                        </span>
                    </div>

                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($class->students as $student)
                            <div class="flex items-center justify-between p-5 hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm uppercase">
                                        {{ substr($student->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-sm text-gray-900 dark:text-gray-100">{{ $student->name }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $student->email }}</p>
                                    </div>
                                </div>
                                <form action="{{ route('admin.classes.students.remove', [$class->id, $student->id]) }}" method="POST" onsubmit="return confirm('Keluarkan {{ $student->name }} dari kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-900/30 rounded-lg hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors">
                                        Keluarkan
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="p-16 text-center">
                                <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-gray-750 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Belum ada siswa di kelas ini</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Tambahkan siswa menggunakan form di sebelah kiri.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
