<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
            {{ __('Tambah Pengguna Baru') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Masukkan nama lengkap" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div>
                        <x-input-label for="role" :value="__('Peran (Role)')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <select id="role" name="role" class="block mt-1.5 w-full bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm" required>
                            <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ old('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" required placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="password_confirmation" class="block mt-1.5 w-full" type="password" name="password_confirmation" required placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Simpan Pengguna
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
