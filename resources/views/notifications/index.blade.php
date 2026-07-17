<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full gap-4">
            <h2 class="font-bold text-2xl text-slate-900 tracking-tight leading-tight">
                <i class="fa-solid fa-bell"></i> Semua Notifikasi
            </h2>
            @if ($notifications->total() > 0)
                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-xs font-bold text-indigo-600 hover:underline transition-all">
                        Tandai semua dibaca
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 p-4 rounded-xl shadow-sm backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white  rounded-[18px] border border-slate-200/80 shadow-soft overflow-hidden divide-y divide-slate-100">
            @forelse ($notifications as $notif)
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
                <div class="flex items-start gap-4 p-5 {{ $notif->isUnread() ? 'bg-indigo-500/5' : '' }} hover:bg-slate-50/50 transition-colors duration-150">
                    {{-- Icon --}}
                    <div class="shrink-0 w-10 h-10 rounded-lg {{ $config['class'] }} flex items-center justify-center text-xl">
                        <i class="{{ $config['icon'] }}"></i>
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-bold text-slate-900  leading-snug">{{ $notif->title }}</p>
                                <p class="text-xs text-slate-500  mt-1 leading-relaxed">{{ $notif->message }}</p>
                                <p class="text-[10px] text-slate-400  font-mono mt-1.5">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                            @if ($notif->isUnread())
                                <span class="shrink-0 w-2.5 h-2.5 rounded-full bg-indigo-600 mt-1.5"></span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-16 text-center">
                    <div class="w-16 h-16 rounded-xl bg-indigo-500/10 text-indigo-600 border border-indigo-500/15 flex items-center justify-center mx-auto mb-5 text-2xl">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h3 class="font-bold text-slate-800  text-lg">Tidak ada notifikasi</h3>
                    <p class="text-xs text-slate-400  mt-1.5 max-w-sm mx-auto leading-relaxed">Notifikasi akan muncul di sini saat ada aktivitas pembelajaran baru.</p>
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
