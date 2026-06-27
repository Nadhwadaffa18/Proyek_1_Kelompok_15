<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Detail Kuis & Kelola Soal') }}
                </h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kelas: {{ $quiz->class->name }} | Durasi: {{ $quiz->duration_minutes }} menit</p>
            </div>
            <a href="{{ route('teacher.classes.show', $quiz->class->id) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Kiri: Daftar Soal -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Daftar Soal Pilihan Ganda</h3>
                        <a href="{{ route('teacher.quizzes.questions.create', $quiz->id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-xs font-semibold rounded-xl text-white shadow-md shadow-indigo-500/10 hover:opacity-90 transform active:scale-[0.98] transition-all">
                            + Tambah Soal
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($quiz->questions as $index => $question)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm relative space-y-4">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-sm text-gray-900 dark:text-gray-100 flex gap-2">
                                        <span>{{ $index + 1 }}.</span>
                                        <span>{{ $question->question }}</span>
                                    </h4>
                                    <form action="{{ route('teacher.quizzes.questions.destroy', $question->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus soal ini?')" class="text-xs text-rose-500 hover:text-rose-700">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                                    <div class="p-3 rounded-lg border {{ $question->answer === 'A' ? 'bg-emerald-500/5 border-emerald-500/35 text-emerald-600 font-semibold' : 'border-gray-100 dark:border-gray-700 text-gray-600 dark:text-gray-300' }}">
                                        A. {{ $question->option_a }}
                                    </div>
                                    <div class="p-3 rounded-lg border {{ $question->answer === 'B' ? 'bg-emerald-500/5 border-emerald-500/35 text-emerald-600 font-semibold' : 'border-gray-100 dark:border-gray-700 text-gray-600 dark:text-gray-300' }}">
                                        B. {{ $question->option_b }}
                                    </div>
                                    <div class="p-3 rounded-lg border {{ $question->answer === 'C' ? 'bg-emerald-500/5 border-emerald-500/35 text-emerald-600 font-semibold' : 'border-gray-100 dark:border-gray-700 text-gray-600 dark:text-gray-300' }}">
                                        C. {{ $question->option_c }}
                                    </div>
                                    <div class="p-3 rounded-lg border {{ $question->answer === 'D' ? 'bg-emerald-500/5 border-emerald-500/35 text-emerald-600 font-semibold' : 'border-gray-100 dark:border-gray-700 text-gray-600 dark:text-gray-300' }}">
                                        D. {{ $question->option_d }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 text-center text-gray-400 border border-gray-100 dark:border-gray-700 text-sm">
                                Belum ada soal ditambahkan ke kuis ini. Silakan klik "+ Tambah Soal" di atas.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kolom Kanan: Hasil Pengerjaan Siswa -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Hasil Kuis Siswa</h3>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                        <ul class="divide-y divide-gray-100 dark:divide-gray-700 max-h-[500px] overflow-y-auto">
                            @forelse ($quiz->attempts as $attempt)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm leading-none">{{ $attempt->student->name }}</h4>
                                        <span class="text-[10px] text-gray-400 mt-1 block">{{ $attempt->student->email }}</span>
                                    </div>
                                    <div class="bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1.5 rounded-lg text-xs font-bold text-indigo-600 dark:text-indigo-400">
                                        Skor: {{ $attempt->score }}
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-gray-400 text-sm">Belum ada siswa yang mengerjakan kuis ini.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
