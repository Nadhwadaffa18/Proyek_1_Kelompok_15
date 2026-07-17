<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Edit Kelas') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white rounded-[18px] border border-slate-200/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.classes.update', $class->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Nama Kelas -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Kelas')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name', $class->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Guru Pengampu -->
                    <div>
                        <x-input-label for="teacher_id" :value="__('Guru Pengampu')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <select id="teacher_id" name="teacher_id" class="block mt-1.5 w-full bg-white text-slate-900 border border-slate-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm" required>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} ({{ $teacher->email }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.classes.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Perbarui Kelas
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
