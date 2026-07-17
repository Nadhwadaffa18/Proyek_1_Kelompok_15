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
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-[#0F172A] min-h-screen relative overflow-x-hidden flex items-center justify-center py-12 px-4">
        <!-- Background decorative glows -->
        <div class="absolute top-0 left-1/4 w-[350px] h-[350px] bg-blue-500/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[450px] h-[450px] bg-indigo-500/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-[440px] z-10">
            <!-- Branding -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <img src="{{ asset('images/logo_aksara.png') }}" alt="Logo Aksara"  class="h-20    w-auto mx-auto">
                    <span class="font-bold text-3xl tracking-tight bg-gradient-to-r from-[#2563EB] to-[#4F46E5] bg-clip-text text-transparent font-display">Aksara</span>
                </a>
                <p class="text-slate-500 text-sm mt-2">Sistem Manajemen Pembelajaran Digital</p>
            </div>

            <!-- Auth Card (Glassmorphic) -->
            <div class="bg-white/72 backdrop-blur-[18px] border border-white/45 rounded-card shadow-soft-lg p-8 text-[#0F172A]">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
