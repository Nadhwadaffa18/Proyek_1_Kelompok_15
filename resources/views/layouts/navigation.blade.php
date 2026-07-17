<!-- Desktop Sidebar -->
<aside
    :class="sidebarCollapsed ? 'w-20' : 'w-[280px]'"
    class="fixed top-0 bottom-0 left-0 bg-white/72 backdrop-blur-[18px] border-r border-white/45 shadow-[0_20px_60px_rgba(37,99,235,0.04)] hidden lg:flex flex-col z-20 transition-all duration-300">
    <!-- Brand Branding -->
    <div class="h-[72px] flex items-center justify-between px-6 border-b border-slate-100">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center w-full">

    <!-- Saat sidebar terbuka -->
    <div x-show="!sidebarCollapsed"
         x-transition
         class="flex items-center gap-2.5">
       <img
        src="{{ asset('images/logo_aksara.png') }}"
        alt="Logo Aksara"
        class="h-8 w-auto">
        <span class="font-bold text-2xl tracking-tight bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent font-display">
            Aksara
        </span>

        <span class="text-[10px] font-bold font-mono px-2 py-0.5 rounded-full bg-white text-primary border border-white/45 capitalize">
            {{ Auth::user()->role }}
        </span>
    </div>

    <!-- Saat sidebar ditutup -->
    <span
        x-show="sidebarCollapsed"
        x-transition
        class="flex items-center justify-center">
        <img
        src="{{ asset('images/logo_aksara.png') }}"
        alt="Logo Aksara"
        class="h-8 w-auto">
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
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'pattern' => 'admin.dashboard', 'icon' => 'fa-solid fa-table-columns'],
                    ['route' => 'admin.users.index', 'label' => 'Kelola User', 'pattern' => 'admin.users.*', 'icon' => 'fa-solid fa-user'],
                    ['route' => 'admin.classes.index', 'label' => 'Kelola Kelas', 'pattern' => 'admin.classes.*', 'icon' => 'fa-solid fa-graduation-cap'],
                ];
            } elseif ($role === 'guru') {
                $links = [
                    ['route' => 'teacher.dashboard', 'label' => 'Dashboard', 'pattern' => 'teacher.dashboard', 'icon' => 'fa-solid fa-table-columns'],
                    ['route' => 'teacher.materials.index', 'label' => 'Materi', 'pattern' => 'teacher.materials.*', 'icon' => 'fa-solid fa-book-open'],
                    ['route' => 'teacher.assignments.index', 'label' => 'Tugas', 'pattern' => 'teacher.assignments.*', 'icon' => 'fa-solid fa-file-lines'],
                    ['route' => 'teacher.quizzes.index', 'label' => 'Kuis', 'pattern' => 'teacher.quizzes.*', 'icon' => 'fa-solid fa-award'],
                ];
            } elseif ($role === 'siswa') {
                $links = [
                    ['route' => 'student.dashboard', 'label' => 'Dashboard', 'pattern' => 'student.dashboard', 'icon' => 'fa-solid fa-table-columns'],
                    ['route' => 'student.classes.index', 'label' => 'Daftar Kelas', 'pattern' => 'student.classes.*', 'icon' => 'fa-solid fa-graduation-cap'],
                    ['route' => 'student.grades', 'label' => 'Nilai', 'pattern' => 'student.grades', 'icon' => 'fa-solid fa-chart-line'],
                ];
            }
        @endphp

        @foreach ($links as $link)
            @php
                $isActive = request()->routeIs($link['pattern']);
            @endphp
            <a href="{{ route($link['route']) }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all group {{ $isActive ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                <i class="{{ $link['icon'] }} w-5 text-center shrink-0 transition-transform group-hover:scale-110 text-base {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                <span
    x-show="!sidebarCollapsed"
    x-transition.opacity.duration.200ms
>
    {{ $link['label'] }}
</span>
            </a>
        @endforeach
    </nav>

    <!-- Sidebar Profile Settings & Quick Info -->
    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
        <div class="p-3 rounded-xl border border-slate-300 bg-white">
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-400 truncate font-mono mt-0.5">{{ Auth::user()->email }}</p>
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
         class="relative flex flex-col w-full max-w-[280px] h-full bg-white shadow-soft-lg">
        
        <!-- Close Button -->
        <div class="h-[72px] flex items-center justify-between px-6 border-b border-slate-100">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <span class="font-bold text-xl tracking-tight bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent font-display">Aksara</span>
            </a>
            <button @click="sidebarOpen = false" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
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
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ $isActive ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                    <i class="{{ $link['icon'] }} w-5 text-center shrink-0 text-base {{ $isActive ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>
                        {{ $link['label'] }}
                    </span>
                </a>
            @endforeach
        </nav>

        <!-- Profile Settings Info mobile footer -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            <div class="p-3 rounded-xl border border-slate-100 bg-white">
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-400 truncate font-mono mt-0.5">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
