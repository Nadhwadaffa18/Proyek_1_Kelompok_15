<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Halaman semua notifikasi milik user yang login.
     */
    public function index()
    {
        $notifications = auth()->user()
            ->appNotifications()
            ->paginate(20);

        // Tandai semua sebagai sudah dibaca saat halaman dibuka
        auth()->user()
            ->appNotifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Tandai satu notifikasi sebagai sudah dibaca dan redirect ke URL tujuan.
     */
    public function read(int $id)
    {
        $notification = AppNotification::where('user_id', auth()->id())
            ->findOrFail($id);

        $notification->update(['read_at' => now()]);

        return redirect($notification->url ?? route('dashboard'));
    }

    /**
     * Tandai semua notifikasi user sebagai sudah dibaca (via AJAX atau form).
     */
    public function markAllRead()
    {
        auth()->user()
            ->appNotifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }
}
