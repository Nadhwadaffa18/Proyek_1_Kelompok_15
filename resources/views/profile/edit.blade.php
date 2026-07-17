<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-2xl text-slate-900 tracking-tight leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="p-6 sm:p-8 bg-white rounded-[18px] border border-slate-200/80 overflow-hidden shadow-soft rounded-card">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white rounded-[18px] border border-slate-200/80 overflow-hidden shadow-soft rounded-card">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white rounded-[18px] border border-slate-200/80 overflow-hidden shadow-soft rounded-card">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
