<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aksara - Aplikasi Pembelajaran Digital</title>

        <!-- Google Fonts: Outfit & Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            outfit: ['Outfit', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">
        <!-- Background decorative glows -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Header -->
        <header class="relative z-10 max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
            <div class="flex items-center">
                <span class="font-outfit font-bold text-xl tracking-tight text-white bg-clip-text bg-gradient-to-r from-white to-slate-400">Aksara</span>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm shadow-lg shadow-indigo-600/15 active:scale-[0.98] transition-all duration-200">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold text-sm border border-slate-700/50 hover:border-slate-600/50 transition-all duration-200">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Hero Section -->
        <main class="relative z-10 max-w-7xl mx-auto px-6 pt-16 pb-24 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <!-- Left Info -->
            <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold uppercase tracking-wider">
                    <span>🚀 Platform Pembelajaran Digital Modern</span>
                </div>

                <h1 class="font-outfit font-extrabold text-5xl md:text-6xl tracking-tight leading-tight text-white">
                    Proses Belajar Mengajar Menjadi <br>
                    <span class="bg-gradient-to-r from-indigo-400 via-blue-400 to-teal-400 bg-clip-text text-transparent">Lebih Interaktif & Efisien</span>
                </h1>

                <p class="text-slate-400 text-lg max-w-2xl mx-auto lg:mx-0">
                    Aksara adalah solusi lengkap manajemen kelas digital yang menghubungkan Admin, Guru, dan Siswa dalam satu ekosistem interaktif untuk mengakses materi, mengumpulkan tugas, serta ujian online.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold text-base shadow-lg shadow-indigo-500/20 hover:opacity-95 transform active:scale-[0.98] transition-all">
                            Masuk Dashboard Anda
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold text-base shadow-lg shadow-indigo-500/20 hover:opacity-95 transform active:scale-[0.98] transition-all">
                            Mulai Belajar Sekarang
                        </a>
                        <a href="#features" class="w-full sm:w-auto px-6 py-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 font-semibold text-base border border-slate-800/80 hover:border-slate-700/80 transition-all">
                            Pelajari Fitur
                        </a>
                    @endauth
                </div>

                <!-- Credential quick guide for testing -->
                <div class="pt-8 border-t border-slate-900 text-left max-w-lg mx-auto lg:mx-0">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">🔑 Akun Demo Pengujian:</p>
                    <div class="grid grid-cols-3 gap-3 text-xs">
                        <div class="p-3 bg-slate-900/60 border border-slate-800 rounded-xl space-y-1">
                            <p class="font-bold text-indigo-400">Admin</p>
                            <p class="text-slate-500 select-all">admin@aksara.com</p>
                            <p class="text-slate-600">pass: password</p>
                        </div>
                        <div class="p-3 bg-slate-900/60 border border-slate-800 rounded-xl space-y-1">
                            <p class="font-bold text-emerald-400">Guru</p>
                            <p class="text-slate-500 select-all">guru@aksara.com</p>
                            <p class="text-slate-600">pass: password</p>
                        </div>
                        <div class="p-3 bg-slate-900/60 border border-slate-800 rounded-xl space-y-1">
                            <p class="font-bold text-amber-400">Siswa</p>
                            <p class="text-slate-500 select-all">siswa@aksara.com</p>
                            <p class="text-slate-600">pass: password</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Visual Cards (Mockup styling) -->
            <div class="lg:col-span-5 relative">
                <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-indigo-500 to-blue-500 opacity-20 blur-xl"></div>
                
                <!-- Main Mockup Container -->
                <div class="relative bg-slate-900/85 backdrop-blur-md rounded-2xl border border-slate-800/85 p-6 space-y-6 shadow-2xl">
                    <div class="flex items-center justify-between border-b border-slate-800/80 pb-4">
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        </div>
                        <span class="text-xs text-slate-500 font-medium font-outfit">aksara-digital-classroom.app</span>
                    </div>

                    <!-- Role features details inside mockup -->
                    <div class="space-y-4">
                        <!-- Admin Card -->
                        <div class="p-4 rounded-xl bg-slate-950/70 border border-indigo-500/10 flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 font-bold text-sm">AD</div>
                            <div>
                                <h4 class="text-sm font-bold text-white">Panel Administrator</h4>
                                <p class="text-xs text-slate-500">Kelola pengguna (Guru/Siswa) & pembuatan kelas</p>
                            </div>
                        </div>

                        <!-- Teacher Card -->
                        <div class="p-4 rounded-xl bg-slate-950/70 border border-emerald-500/10 flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 font-bold text-sm">GR</div>
                            <div>
                                <h4 class="text-sm font-bold text-white">Kelola Materi & Ujian</h4>
                                <p class="text-xs text-slate-500">Unggah berkas, tugaskan tugas, & bikin kuis</p>
                            </div>
                        </div>

                        <!-- Student Card -->
                        <div class="p-4 rounded-xl bg-slate-950/70 border border-amber-500/10 flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400 font-bold text-sm">SW</div>
                            <div>
                                <h4 class="text-sm font-bold text-white">Ruang Belajar Siswa</h4>
                                <p class="text-xs text-slate-500">Akses materi, submit tugas, & ujian dengan timer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Features grid -->
        <section id="features" class="relative z-10 max-w-7xl mx-auto px-6 py-20 border-t border-slate-900">
            <div class="text-center space-y-4 mb-16">
                <h2 class="font-outfit font-bold text-3xl md:text-4xl text-white">Keunggulan Utama Aksara</h2>
                <p class="text-slate-400 text-sm max-w-lg mx-auto">Platform pembelajaran all-in-one yang dirancang untuk mendukung guru dan mempermudah siswa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-900/40 border border-slate-900 rounded-2xl p-8 space-y-4 hover:border-slate-800 hover:bg-slate-900/60 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400 font-bold text-lg mb-4">
                        📚
                    </div>
                    <h3 class="font-outfit font-bold text-lg text-white">Materi Terstruktur</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">Guru dapat dengan mudah mengunggah berkas PDF, presentasi, atau dokumen pendukung per materi kelas agar siswa dapat langsung membacanya.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-900/40 border border-slate-900 rounded-2xl p-8 space-y-4 hover:border-slate-800 hover:bg-slate-900/60 transition-all duration-300">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-400 font-bold text-lg mb-4">
                        ⏱️
                    </div>
                    <h3 class="font-outfit font-bold text-lg text-white">Kuis dengan Timer</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">Ujian kuis interaktif yang dibatasi waktu secara real-time. Jika waktu pengerjaan habis, jawaban siswa otomatis terkirim untuk dinilai.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-900/40 border border-slate-900 rounded-2xl p-8 space-y-4 hover:border-slate-800 hover:bg-slate-900/60 transition-all duration-300">
                    <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-400 font-bold text-lg mb-4">
                        📊
                    </div>
                    <h3 class="font-outfit font-bold text-lg text-white">Gradebook Terintegrasi</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">Rekap nilai tugas dan kuis otomatis tersimpan dengan aman di database. Siswa dapat langsung melihat nilai beserta feedback tertulis dari guru.</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-10 max-w-7xl mx-auto px-6 py-8 border-t border-slate-900 text-center text-slate-500 text-xs">
            <p>&copy; 2026 Aksara Digital Classroom. Built with Laravel and Tailwind CSS.</p>
        </footer>
    </body>
</html>
