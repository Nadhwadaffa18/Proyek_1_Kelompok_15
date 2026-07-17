<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Edit Pengguna') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white rounded-[18px] border border-slate-200/80 shadow-soft overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Nama -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div>
                        <x-input-label for="role" :value="__('Peran (Role)')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <select id="role" name="role" class="block mt-1.5 w-full bg-white  text-slate-900 border border-slate-200  focus:border-indigo-500  focus:ring-1 focus:ring-indigo-500  rounded-[12px] shadow-sm py-2.5 px-3.5 transition-all text-sm" required>
                            <option value="siswa" {{ old('role', $user->role) === 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ old('role', $user->role) === 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                   <!-- Info Password -->
                    <div class="p-4 bg-blue-500/5 border border-blue-500/10 rounded-xl text-xs text-blue-600  font-medium flex items-start gap-2">
                        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ __('Kosongkan kata sandi dan konfirmasi jika tidak ingin menggantinya.') }}</span>
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi Baru')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-xs font-bold uppercase tracking-wider text-slate-500 font-mono" />
                        <x-text-input id="password_confirmation" class="block mt-1.5 w-full" type="password" name="password_confirmation" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-100 ">
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                            Batal
                        </a>
                        <x-primary-button>
                            Perbarui Pengguna
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
