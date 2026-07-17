<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Aksara') }}</title>

        <!-- Google Fonts: Lato & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Lato:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Tailwind and Alpine CDNs -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#2563EB',
                            secondary: '#4F46E5',
                            accent: '#60A5FA',
                            success: '#22C55E',
                            warning: '#F59E0B',
                            danger: '#EF4444',
                            'text-primary': '#0F172A',
                            'text-secondary': '#64748B',
                            background: '#F8FAFC',
                            surface: '#FFFFFF',
                        },
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                            display: ['Lato', 'sans-serif'],
                        },
                        borderRadius: {
                            card: '20px',
                            control: '12px',
                            button: '14px',
                            pill: '999px',
                        },
                        boxShadow: {
                            soft: '0 8px 30px rgba(0,0,0,0.04)',
                            'soft-lg': '0 20px 60px rgba(37,99,235,0.12)',
                        }
                    }
                }
            }
        </script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased text-[#0F172A] bg-[#F8FAFC]">
        <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" class="min-h-screen flex bg-[#F8FAFC]">
            <!-- Navigation contains both Sidebar (desktop/mobile) and Sticky Header -->
            @include('layouts.navigation')

            <!-- Main content container -->
            <div  :class="sidebarCollapsed ? 'lg:pl-20' : 'lg:pl-[280px]'"
    class="flex-grow flex flex-col min-w-0 min-h-screen transition-all duration-300 bg-gradient-to-b from-blue-500/70 via-blue-100 to-white">
                <!-- Sticky Top Navigation -->
                <header class="h-[72px] sticky top-0 z-30 bg-white/72 backdrop-blur-[18px] border-b border-white/45 shadow-[0_20px_60px_rgba(37,99,235,0.04)] px-6 flex items-center justify-between">
                    <!-- Left: Menu trigger & Page title -->
                    <div class="flex items-center gap-4">

                <!-- Mobile -->
                <button @click="sidebarOpen = true"
                    class="lg:hidden p-2 rounded-xl text-slate-500 hover:bg-slate-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <!-- Desktop -->
                <button @click="sidebarCollapsed = !sidebarCollapsed"
                    class="hidden lg:flex items-center justify-center w-10 h-10 rounded-xl text-slate-500 hover:bg-slate-100 transition-all duration-300">
                    <i class="fa-solid fa-bars"></i>
                </button>
                @isset($header)
                    <div class="font-semibold text-lg text-slate-900 leading-tight">
                        {{ $header }}
                    </div>
                @endisset
            </div>

                    <!-- Right: Notifications & Profile -->
                    <div class="flex items-center gap-4">
                        <!-- Notification Bell Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            @php $unreadCount = auth()->user()->unreadNotificationsCount(); @endphp
                            <button @click="open = !open" @click.away="open = false"
                                class="relative p-2 rounded-xl text-slate-500 hover:bg-slate-100 transition-colors focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @if ($unreadCount > 0)
                                    <span class="absolute top-1 right-1 flex h-4.5 w-4.5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white leading-none border-2 border-white">
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
                                <div class="bg-white rounded-2xl shadow-soft-lg border border-slate-200/60 overflow-hidden">
                                    <div class="px-4 py-3 border-b border-slate-200/60 flex items-center justify-between bg-slate-50/50">
                                        <span class="font-bold text-sm text-slate-900">Notifikasi</span>
                                        <a href="{{ route('notifications.index') }}" class="text-xs text-indigo-600 hover:underline font-semibold">Lihat Semua</a>
                                    </div>
                                    @php
                                        $recentNotifs = auth()->user()->appNotifications()->take(5)->get();
                                    @endphp
                                    <div class="max-h-[300px] overflow-y-auto divide-y divide-slate-100">
                                        @forelse ($recentNotifs as $notif)
                                            @php
                                    $iconMap = [
                                        'materi_baru' => [
                                            'icon' => 'fa-solid fa-file-lines',
                                            'class' => 'bg-blue-100 text-blue-600',
                                        ],
                                        'tugas_baru' => [
                                            'icon' => 'fa-solid fa-clipboard-list',
                                            'class' => 'bg-amber-100 text-amber-600',
                                        ],
                                        'kuis_baru' => [
                                            'icon' => 'fa-solid fa-circle-question',
                                            'class' => 'bg-purple-100 text-purple-600',
                                        ],
                                        'nilai_keluar' => [
                                            'icon' => 'fa-solid fa-trophy',
                                            'class' => 'bg-emerald-100 text-emerald-600',
                                        ],
                                        'reply_forum' => [
                                            'icon' => 'fa-solid fa-comments',
                                            'class' => 'bg-sky-100 text-sky-600',
                                        ],
                                    ];

                                    $config = $iconMap[$notif->type] ?? [
                                        'icon' => 'fa-solid fa-bell',
                                        'class' => 'bg-slate-100 text-slate-600',
                                    ];
                                @endphp
                                            <a href="{{ route('notifications.read', $notif->id) }}"
                                               class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition-colors {{ $notif->isUnread() ? 'bg-indigo-50/40' : '' }}">
                                                <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center {{ $config['class'] }}">
    <i class="{{ $config['icon'] }}"></i>
</div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs font-semibold text-slate-900 truncate">{{ $notif->title }}</p>
                                                    <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $notif->message }}</p>
                                                    <p class="text-[10px] text-slate-400 mt-1 font-mono">{{ $notif->created_at->diffForHumans() }}</p>
                                                </div>
                                                @if ($notif->isUnread())
                                                    <span class="shrink-0 w-2 h-2 rounded-full bg-indigo-500 mt-1.5"></span>
                                                @endif
                                            </a>
                                        @empty
                                            <div class="px-4 py-8 text-center text-sm text-slate-400">
                                                <i class="fa-solid fa-bell"></i> Tidak ada notifikasi
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Settings Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false"
                                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 bg-white/50 hover:bg-slate-100 transition-all focus:outline-none">
                                <span class="text-sm font-semibold text-slate-700 pr-1">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 origin-top-right z-50"
                                 style="display: none;">
                                <div class="bg-white rounded-2xl shadow-soft-lg border border-slate-200/60 overflow-hidden py-1">
                                    <div class="px-4 py-2 border-b border-slate-100 ">
                                        <p class="text-xs text-slate-400">Role</p>
                                        <p class="text-xs font-semibold text-indigo-800 capitalize">{{ Auth::user()->role }}</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-100/90 transition-colors">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ __('Profile') }}
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-rose-600 hover:bg-rose-50 transition-colors text-left">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-grow p-6 md:p-8">
                {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
