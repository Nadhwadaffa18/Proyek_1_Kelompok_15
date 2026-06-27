<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                🔔 Semua Notifikasi
            </h2>
            @if ($notifications->total() > 0)
                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors">
                        Tandai semua dibaca
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden divide-y divide-gray-100 dark:divide-gray-700">

                @forelse ($notifications as $notif)
                    @php
                        $iconMap = [
                            'materi_baru'  => ['icon' => '📄', 'color' => 'text-blue-500',   'bg' => 'bg-blue-50 dark:bg-blue-900/20'],
                            'tugas_baru'   => ['icon' => '📝', 'color' => 'text-orange-500',  'bg' => 'bg-orange-50 dark:bg-orange-900/20'],
                            'kuis_baru'    => ['icon' => '❓', 'color' => 'text-purple-500',  'bg' => 'bg-purple-50 dark:bg-purple-900/20'],
                            'nilai_keluar' => ['icon' => '🏆', 'color' => 'text-emerald-500', 'bg' => 'bg-emerald-50 dark:bg-emerald-900/20'],
                            'reply_forum'  => ['icon' => '💬', 'color' => 'text-indigo-500',  'bg' => 'bg-indigo-50 dark:bg-indigo-900/20'],
                        ];
                        $style = $iconMap[$notif->type] ?? ['icon' => '🔔', 'color' => 'text-gray-500', 'bg' => 'bg-gray-50 dark:bg-gray-700'];
                    @endphp

                    <div class="flex items-start gap-4 p-5 {{ $notif->isUnread() ? 'bg-indigo-50/50 dark:bg-indigo-900/10' : '' }} hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        {{-- Icon --}}
                        <div class="shrink-0 w-10 h-10 rounded-full {{ $style['bg'] }} flex items-center justify-center text-xl">
                            {{ $style['icon'] }}
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $notif->title }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">{{ $notif->message }}</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                                @if ($notif->isUnread())
                                    <span class="shrink-0 w-2 h-2 rounded-full bg-indigo-500 mt-1.5"></span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-16 text-center">
                        <div class="text-5xl mb-4">🔔</div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 text-lg">Tidak ada notifikasi</h3>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Notifikasi akan muncul di sini saat ada aktivitas baru.</p>
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
    </div>
</x-app-layout>
