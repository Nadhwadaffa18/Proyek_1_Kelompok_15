<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Tugas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('teacher.assignments.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Pilih Kelas -->
                        <div>
                            <x-input-label for="class_id" :value="__('Pilih Kelas')" />
                            <select id="class_id" name="class_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('class_id')" class="mt-2" />
                        </div>

                        <!-- Judul Tugas -->
                        <div>
                            <x-input-label for="title" :value="__('Judul Tugas')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Latihan Soal Algoritma Pemrograman" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Deskripsi / Instruksi -->
                        <div>
                            <x-input-label for="description" :value="__('Instruksi Tugas')" />
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Tuliskan petunjuk pengerjaan tugas di sini...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Tenggat Waktu (Deadline) -->
                        <div>
                            <x-input-label for="deadline" :value="__('Tenggat Waktu (Deadline)')" />
                            <x-text-input id="deadline" class="block mt-1 w-full" type="datetime-local" name="deadline" :value="old('deadline')" required />
                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('teacher.assignments.index') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-sm font-semibold rounded-xl text-white shadow-md shadow-indigo-500/10 hover:opacity-90 transform active:scale-[0.98] transition-all">
                                Buat Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
