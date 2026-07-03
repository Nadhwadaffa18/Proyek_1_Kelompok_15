<!-- Desktop Sidebar -->
<aside class="fixed top-0 bottom-0 left-0 w-[280px] bg-white dark:bg-slate-900 border-r border-slate-200/80 dark:border-slate-800/80 hidden lg:flex flex-col z-20">
    <!-- Brand Branding -->
    <div class="h-[72px] flex items-center justify-between px-6 border-b border-slate-200/80 dark:border-slate-800/80">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <span class="font-bold text-2xl tracking-tight bg-gradient-to-r from-indigo-600 to-indigo-400 bg-clip-text text-transparent font-sans">Aksara</span>
            <span class="text-[10px] font-bold font-mono px-2 py-0.5 rounded-full bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/15 capitalize">
                {{ Auth::user()->role }}
            </span>
        </a>
    </div>

    <!-- Navigation Menu Items -->
    <nav class="flex-grow py-6 px-4 space-y-1.5 overflow-y-auto">
        @php
            $role = Auth::user()->role;
            $links = [];
            if ($role === 'admin') {
                $links = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'pattern' => 'admin.dashboard', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                    ['route' => 'admin.users.index', 'label' => 'Kelola User', 'pattern' => 'admin.users.*', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['route' => 'admin.classes.index', 'label' => 'Kelola Kelas', 'pattern' => 'admin.classes.*', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ];
            } elseif ($role === 'guru') {
                $links = [
                    ['route' => 'teacher.dashboard', 'label' => 'Dashboard', 'pattern' => 'teacher.dashboard', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                    ['route' => 'teacher.materials.index', 'label' => 'Materi', 'pattern' => 'teacher.materials.*', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['route' => 'teacher.assignments.index', 'label' => 'Tugas', 'pattern' => 'teacher.assignments.*', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                    ['route' => 'teacher.quizzes.index', 'label' => 'Kuis', 'pattern' => 'teacher.quizzes.*', 'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            } elseif ($role === 'siswa') {
                $links = [
                    ['route' => 'student.dashboard', 'label' => 'Dashboard', 'pattern' => 'student.dashboard', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                    ['route' => 'student.classes.index', 'label' => 'Daftar Kelas', 'pattern' => 'student.classes.*', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['route' => 'student.grades', 'label' => 'Nilai', 'pattern' => 'student.grades', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                ];
            }
        @endphp

        @foreach ($links as $link)
            @php
                $isActive = request()->routeIs($link['pattern']);
            @endphp
            <a href="{{ route($link['route']) }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all group {{ $isActive ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/15' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 dark:text-slate-400 dark:hover:text-white dark:hover:bg-slate-800/60' }}">
                <svg class="w-5 h-5 shrink-0 transition-transform group-hover:scale-105 {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-slate-600 dark:text-slate-500 dark:group-hover:text-slate-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}" />
                </svg>
                <span>{{ $link['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- Sidebar Profile Settings & Quick Info -->
    <div class="p-4 border-t border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
        <div class="flex items-center gap-3 p-2.5 rounded-xl border border-slate-200/40 dark:border-slate-800/40 bg-white dark:bg-slate-900">
            <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/20">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-slate-800 dark:text-slate-200 truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-400 dark:text-slate-500 truncate font-mono">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Sidebar Drawer (Alpine-controlled) -->
<div x-show="sidebarOpen" 
     class="fixed inset-0 z-50 lg:hidden" 
     style="display: none;" 
     role="dialog" 
     aria-modal="true">
    
    <!-- Backdrop Overlay -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <!-- Drawer Panel -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="relative flex flex-col w-full max-w-[280px] h-full bg-white dark:bg-slate-900 shadow-soft-lg">
        
        <!-- Close Button -->
        <div class="h-[72px] flex items-center justify-between px-6 border-b border-slate-200/80 dark:border-slate-800/80">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <span class="font-bold text-xl tracking-tight bg-gradient-to-r from-indigo-600 to-indigo-400 bg-clip-text text-transparent font-sans">Aksara</span>
            </a>
            <button @click="sidebarOpen = false" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Links -->
        <nav class="flex-grow py-6 px-4 space-y-1.5 overflow-y-auto">
            @foreach ($links as $link)
                @php
                    $isActive = request()->routeIs($link['pattern']);
                @endphp
                <a href="{{ route($link['route']) }}" 
                   @click="sidebarOpen = false"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ $isActive ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/15' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 dark:text-slate-400 dark:hover:text-white dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5 shrink-0 {{ $isActive ? 'text-white' : 'text-slate-400 dark:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}" />
                    </svg>
                    <span>{{ $link['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <!-- Profile Settings Info mobile footer -->
        <div class="p-4 border-t border-slate-200/80 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50">
            <div class="flex items-center gap-3 p-2.5 rounded-xl border border-slate-200/40 dark:border-slate-800/40 bg-white dark:bg-slate-900">
                <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/20">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-800 dark:text-slate-200 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 truncate font-mono">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
