<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aksara - Aplikasi Pembelajaran Digital</title>

        <!-- Google Fonts: Lato & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Lato:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Tailwind CSS CDN -->
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
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
                50% { transform: translateY(-12px) rotate(2deg) scale(1.03); }
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            .animate-float-delayed {
                animation: float 6s ease-in-out infinite;
                animation-delay: 2s;
            }
            .animate-float-slow {
                animation: float 8s ease-in-out infinite;
                animation-delay: 4s;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.72);
                backdrop-filter: blur(18px);
                border: 1px solid rgba(255, 255, 255, 0.45);
                box-shadow: 0 20px 60px rgba(37, 99, 235, 0.08);
            }

            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(24px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-up {
                opacity: 0;
                animation: fadeUp .8s ease-out forwards;
            }

            /* Delay */

            .delay-500 { animation-delay: .5s; }

        </style>
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-[#0F172A] min-h-screen relative overflow-x-hidden">
        <!-- Background decorative glows -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[600px] h-[600px] bg-indigo-500/5 rounded-full blur-[150px] pointer-events-none"></div>

        <!-- Header -->
        <header class="animate-fade-up sticky top-0 z-30 bg-white/72 backdrop-blur-[18px] border-b border-white/45 shadow-[0_20px_60px_rgba(37,99,235,0.02)]">
            <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
                <div class="flex items-center gap-8">
                    <a href="/" class="flex items-center gap-3">
                        <!-- Logo -->
                        <img
                            src="{{ asset('images/logo_aksara.png') }}"
                            alt="Logo Aksara"
                            class="w-10 h-10 object-contain">
                        <!-- Nama -->
                        <span class="font-display font-extrabold text-2xl tracking-tight bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                            Aksara
                        </span>
                </a>
                    <nav class="hidden md:flex items-center gap-6">
                        <a href="#hero" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Beranda</a>
                        <a href="#features" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Fitur</a>
                        <a href="#forum" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Forum</a>
                        <a href="#about" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Tentang</a>
                    </nav>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-button bg-primary hover:bg-primary/95 text-white font-semibold text-sm shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2.5 font-semibold rounded-button text-slate-600  border border-slate-200 hover:text-slate-900 transition-colors">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-button bg-gradient-to-r from-primary to-secondary text-white font-semibold text-sm shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main id="hero" class="relative z-10 max-w-7xl mx-auto px-6 pt-16 pb-24 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Left Info -->
            <div class="lg:col-span-7 space-y-8 text-center lg:text-left animate-fade-up delay-500">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-pill bg-primary/8 text-primary text-xs font-semibold uppercase tracking-wider">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Platform Pembelajaran Digital Modern</span>
                </div>

                <h1 class="font-display font-extrabold text-5xl md:text-6xl tracking-tight leading-[1.1] text-slate-900">
                    Proses Belajar Mengajar Menjadi <br>
                    <span class="bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent">Lebih Interaktif & Efisien</span>
                </h1>

                <p class="text-slate-500 text-lg max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    Aksara adalah solusi lengkap manajemen kelas digital yang menghubungkan Admin, Guru, dan Siswa dalam satu ekosistem interaktif untuk mengakses materi, mengumpulkan tugas, serta ujian online.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-button bg-gradient-to-r from-primary to-secondary text-white font-bold text-base shadow-lg shadow-primary/25 hover:scale-[1.03] active:scale-[0.98] transition-all duration-200">
                            Masuk Dashboard Anda <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 rounded-button bg-gradient-to-r from-primary to-secondary text-white font-bold text-base shadow-lg shadow-primary/25 hover:scale-[1.03] active:scale-[0.98] transition-all duration-200">
                            Mulai Belajar Sekarang <i class="fa-solid fa-play ml-1"></i>
                        </a>
                        <a href="#features" class="w-full sm:w-auto px-6 py-4 rounded-button bg-white hover:bg-slate-50 text-slate-700 font-semibold text-base border border-slate-200 shadow-sm hover:scale-[1.03] active:scale-[0.98] transition-all duration-200">
                            Pelajari Fitur
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Right Visual (Large Aksara Logo & Floating Icons) -->
            <div class="lg:col-span-5 relative flex items-center justify-center min-h-[350px] animate-fade-up delay-500">
                <div class="relative w-72 h-72 rounded-full bg-gradient-to-tr from-primary/10 to-secondary/10 flex items-center justify-center shadow-[0_0_80px_rgba(37,99,235,0.05)] border border-white/40">
                    <span class="font-display font-extrabold text-7xl text-primary/30"><img
                            src="{{ asset('images/logo_aksara.png') }}"
                            alt="Logo Aksara" class="w-40 h-auto animate-float drop-shadow-2xl"></span>
                    
                    <!-- Floating Icon 1 (Top Left) -->
                    <div class="absolute -top-4 -left-4 w-16 h-16 rounded-card glass-card flex items-center justify-center text-primary text-xl animate-float shadow-soft">
                        <i class="fa-solid fa-book-open"></i>
                    </div>

                    <!-- Floating Icon 2 (Top Right) -->
                    <div class="absolute top-12 -right-8 w-14 h-14 rounded-card glass-card flex items-center justify-center text-emerald-500 text-lg animate-float-delayed shadow-soft">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>

                    <!-- Floating Icon 3 (Bottom Left) -->
                    <div class="absolute bottom-4 -left-8 w-14 h-14 rounded-card glass-card flex items-center justify-center text-indigo-500 text-lg animate-float-slow shadow-soft">
                        <i class="fa-solid fa-comments"></i>
                    </div>

                    <!-- Floating Icon 4 (Bottom Right) -->
                    <div class="absolute -bottom-6 right-4 w-16 h-16 rounded-card glass-card flex items-center justify-center text-amber-500 text-xl animate-float shadow-soft">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
        </main>

        <!-- Features Section (Bento Grid) -->
        <section id="features" class="relative z-10 max-w-7xl mx-auto px-6 py-24 border-t border-slate-100 bg-[#F8FAFC]">
            <div class="text-center space-y-4 mb-20">
                <h2 class="font-display font-bold text-3xl md:text-4xl text-slate-900">Keunggulan Utama Aksara</h2>
                <p class="text-slate-500 text-base max-w-lg mx-auto">Platform pembelajaran yang dirancang untuk mendukung pengajar dan mempermudah siswa.</p>
            </div>

            <!-- 4 Bento Cards layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1: Materi Terstruktur (Spans 1 col) -->
                <div class="bg-white/72 backdrop-blur-[18px] border border-white/45 rounded-card p-8 hover:scale-[1.03] hover:shadow-soft-lg transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-xl mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <h3 class="font-display font-bold text-xl text-slate-900 mb-3">Materi Terstruktur</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Pengajar dapat dengan mudah mengunggah berkas PDF, video pembelajaran, atau dokumen pendukung per kelas agar siswa dapat langsung mengaksesnya.</p>
                    </div>
                </div>

                <!-- Card 2: Ujian Real-time (Spans 1 col) -->
                <div class="bg-white/72 backdrop-blur-[18px] border border-white/45 rounded-card p-8 hover:scale-[1.03] hover:shadow-soft-lg transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-500 text-xl mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <h3 class="font-display font-bold text-xl text-slate-900 mb-3">Kuis & Tugas Terjadwal</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Ujian kuis interaktif yang dibatasi waktu secara real-time. Jika waktu pengerjaan habis, jawaban otomatis tersimpan untuk dievaluasi.</p>
                    </div>
                </div>

                <!-- Card 3: Gradebook Terintegrasi (Spans 1 col) -->
                <div class="bg-white/72 backdrop-blur-[18px] border border-white/45 rounded-card p-8 hover:scale-[1.03] hover:shadow-soft-lg transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-500 text-xl mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h3 class="font-display font-bold text-xl text-slate-900 mb-3">Gradebook Otomatis</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Rekap nilai tugas dan kuis otomatis tersimpan dengan aman. Siswa dapat langsung melihat nilai beserta umpan balik tertulis secara langsung.</p>
                    </div>
                </div>
        </section>

                <!-- Card 4: Forum & Jadwal Kelas (Spans 3 cols on desktop for bento feel) -->
                <section id="forum" class="relative z-10 max-w-7xl mx-auto px-6 py-24 border-t border-slate-100 bg-[#F8FAFC]">
                <div class="bg-gradient-to-r from-primary to-secondary rounded-card p-8 md:col-span-3 text-white shadow-lg shadow-primary/10 hover:scale-[1.01] transition-transform duration-300">
                    <div class="max-w-3xl space-y-4">
                        <span class="inline-block text-xs font-bold bg-white/20 px-3 py-1 rounded-full uppercase tracking-wider"><i class="fa-solid fa-comments mr-1"></i> Kolaborasi Aktif</span>
                        <h3 class="font-display font-extrabold text-2xl">Forum Diskusi Interaktif & Jadwal Terpadu</h3>
                        <p class="text-white/80 text-sm leading-relaxed">Tingkatkan keterlibatan kelas melalui ruang diskusi yang didedikasikan untuk materi pelajaran. Guru dan siswa dapat saling berdiskusi, mengajukan pertanyaan, serta mengakses tautan kelas online (seperti Google Meet) langsung dari panel jadwal terpadu.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="max-w-7xl mx-auto px-6 py-24 border-t border-slate-100 text-center space-y-6">
            <h2 class="font-display font-bold text-3xl text-slate-900">Tentang Aksara</h2>
            <p class="text-slate-500 text-base max-w-2xl mx-auto leading-relaxed">
                Aksara dikembangkan untuk merampingkan alur kerja pengajaran online maupun hybrid. Dengan fokus pada kesederhanaan, kecepatan, dan profesionalisme, kami percaya bahwa platform pendidikan modern harus bebas dari distorsi agar proses transfer pengetahuan dapat berjalan maksimal.
            </p>
        </section>

        <!-- Footer -->
        <footer class="max-w-7xl mx-auto px-6 py-12 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between text-slate-400 text-sm">
            <div class="flex items-center gap-2 mb-4 md:mb-0">
                <span class="font-display font-extrabold text-lg bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Aksara</span>
                <span class="text-xs">&copy; 2026 Aksara Digital Classroom. Hak cipta dilindungi.</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-slate-600 transition-colors"><i class="fa-brands fa-github text-lg"></i></a>
                <a href="#" class="hover:text-slate-600 transition-colors"><i class="fa-brands fa-twitter text-lg"></i></a>
                <a href="#" class="hover:text-slate-600 transition-colors"><i class="fa-brands fa-linkedin text-lg"></i></a>
                <a href="#" class="hover:text-slate-600 transition-colors"><i class="fa-brands fa-whatsapp text-lg"></i></a>
            </div>
        </footer>
    </body>
</html>
