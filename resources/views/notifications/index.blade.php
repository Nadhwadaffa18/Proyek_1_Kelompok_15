<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight leading-tight">
                🔔 Semua Notifikasi
            </h2>
            @if ($notifications->total() > 0)
                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline transition-all">
                        Tandai semua dibaca
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-[18px] border border-slate-200/80 dark:border-slate-800/80 shadow-soft overflow-hidden divide-y divide-slate-100 dark:divide-slate-800/60">
            @forelse ($notifications as $notif)
                @php
                    $iconMap = [
                        'materi_baru'  => ['icon' => '📄', 'color' => 'text-blue-500',   'bg' => 'bg-blue-500/10 border border-blue-500/10'],
                        'tugas_baru'   => ['icon' => '📝', 'color' => 'text-orange-500',  'bg' => 'bg-orange-500/10 border border-orange-500/10'],
                        'kuis_baru'    => ['icon' => '❓', 'color' => 'text-purple-500',  'bg' => 'bg-purple-500/10 border border-purple-500/10'],
                        'nilai_keluar' => ['icon' => '🏆', 'color' => 'text-emerald-500', 'bg' => 'bg-emerald-500/10 border border-emerald-500/10'],
                        'reply_forum'  => ['icon' => '💬', 'color' => 'text-indigo-500',  'bg' => 'bg-indigo-500/10 border border-indigo-500/10'],
                    ];
                    $style = $iconMap[$notif->type] ?? ['icon' => '🔔', 'color' => 'text-slate-500', 'bg' => 'bg-slate-500/10 border border-slate-500/10'];
                @endphp

                <div class="flex items-start gap-4 p-5 {{ $notif->isUnread() ? 'bg-indigo-500/5 dark:bg-indigo-900/10' : '' }} hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors duration-150">
                    {{-- Icon --}}
                    <div class="shrink-0 w-10 h-10 rounded-lg {{ $style['bg'] }} flex items-center justify-center text-xl">
                        {{ $style['icon'] }}
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white leading-snug">{{ $notif->title }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">{{ $notif->message }}</p>
                                <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono mt-1.5">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                            @if ($notif->isUnread())
                                <span class="shrink-0 w-2.5 h-2.5 rounded-full bg-indigo-600 mt-1.5"></span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-16 text-center">
                    <div class="w-16 h-16 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/15 flex items-center justify-center mx-auto mb-5 text-2xl">
                        🔔
                    </div>
                    <h3 class="font-bold text-slate-800 dark:text-white text-lg">Tidak ada notifikasi</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1.5 max-w-sm mx-auto leading-relaxed">Notifikasi akan muncul di sini saat ada aktivitas pembelajaran baru.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($notifications->hasPages())
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
