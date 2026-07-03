<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Aksara') }}</title>

        <!-- Google Fonts: Inter & JetBrains Mono -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind and Alpine CDNs -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                DEFAULT: '#4F46E5',
                                dark: '#4338CA',
                            },
                            accent: '#10B981',
                            warning: '#F59E0B',
                            danger: '#F43F5E',
                            'text-primary': '#0F172A',
                            'text-secondary': '#64748B',
                        },
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            mono: ['JetBrains Mono', 'monospace'],
                        },
                        borderRadius: {
                            card: '18px',
                            control: '12px',
                            button: '12px',
                        },
                        boxShadow: {
                            soft: '0 8px 30px rgb(0,0,0,0.04)',
                            'soft-lg': '0 10px 40px rgb(0,0,0,0.06)',
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen relative overflow-x-hidden flex items-center justify-center py-12 px-4">
        <!-- Background decorative glows -->
        <div class="absolute top-0 left-1/4 w-[350px] h-[350px] bg-indigo-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[450px] h-[450px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-[440px] z-10">
            <!-- Branding -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <span class="font-bold text-3xl tracking-tight bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent font-sans">Aksara</span>
                </a>
                <p class="text-slate-400 text-sm mt-2">Sistem Manajemen Pembelajaran Digital</p>
            </div>

            <!-- Auth Card -->
            <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800/80 rounded-[18px] shadow-soft-lg p-8 text-slate-200">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
