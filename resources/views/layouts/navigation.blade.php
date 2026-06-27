<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            {{ __('Kelola User') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.classes.index')" :active="request()->routeIs('admin.classes.*')">
                            {{ __('Kelola Kelas') }}
                        </x-nav-link>
                    @elseif(Auth::user()->role === 'guru')
                        <x-nav-link :href="route('teacher.materials.index')" :active="request()->routeIs('teacher.materials.*')">
                            {{ __('Materi') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.assignments.index')" :active="request()->routeIs('teacher.assignments.*')">
                            {{ __('Tugas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.quizzes.index')" :active="request()->routeIs('teacher.quizzes.*')">
                            {{ __('Kuis') }}
                        </x-nav-link>
                    @elseif(Auth::user()->role === 'siswa')
                        <x-nav-link :href="route('student.classes.index')" :active="request()->routeIs('student.classes.*')">
                            {{ __('Daftar Kelas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('student.grades')" :active="request()->routeIs('student.grades')">
                            {{ __('Nilai') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Notification Bell -->
            <div class="hidden sm:flex sm:items-center sm:ms-2" x-data="{ open: false }">
                @php $unreadCount = auth()->user()->unreadNotificationsCount(); @endphp
                <div class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="relative p-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if ($unreadCount > 0)
                            <span class="absolute top-0.5 right-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white leading-none">
                                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-80 origin-top-right z-50"
                         style="display: none;">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                                <span class="font-bold text-sm text-gray-900 dark:text-gray-100">Notifikasi</span>
                                <a href="{{ route('notifications.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">Lihat Semua</a>
                            </div>
                            @php
                                $recentNotifs = auth()->user()->appNotifications()->take(5)->get();
                            @endphp
                            @forelse ($recentNotifs as $notif)
                                @php
                                    $iconMap = ['materi_baru'=>'📄','tugas_baru'=>'📝','kuis_baru'=>'❓','nilai_keluar'=>'🏆','reply_forum'=>'💬'];
                                    $icon = $iconMap[$notif->type] ?? '🔔';
                                @endphp
                                <a href="{{ route('notifications.read', $notif->id) }}"
                                   class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors {{ $notif->isUnread() ? 'bg-indigo-50/60 dark:bg-indigo-900/10' : '' }}">
                                    <span class="shrink-0 text-lg mt-0.5">{{ $icon }}</span>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $notif->title }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1 mt-0.5">{{ $notif->message }}</p>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if ($notif->isUnread())
                                        <span class="shrink-0 w-2 h-2 rounded-full bg-indigo-500 mt-1.5"></span>
                                    @endif
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
                                    🔔 Tidak ada notifikasi
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-2">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Kelola User') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.classes.index')" :active="request()->routeIs('admin.classes.*')">
                    {{ __('Kelola Kelas') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->role === 'guru')
                <x-responsive-nav-link :href="route('teacher.materials.index')" :active="request()->routeIs('teacher.materials.*')">
                    {{ __('Materi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.assignments.index')" :active="request()->routeIs('teacher.assignments.*')">
                    {{ __('Tugas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teacher.quizzes.index')" :active="request()->routeIs('teacher.quizzes.*')">
                    {{ __('Kuis') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->role === 'siswa')
                <x-responsive-nav-link :href="route('student.classes.index')" :active="request()->routeIs('student.classes.*')">
                    {{ __('Daftar Kelas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student.grades')" :active="request()->routeIs('student.grades')">
                    {{ __('Nilai') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
