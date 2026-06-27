<?php

namespace App\Services;

use App\Models\AppNotification;
use App\Models\Classes;

class NotificationService
{
    /**
     * Kirim notifikasi ke semua siswa di sebuah kelas.
     */
    public static function notifyClassStudents(Classes $class, string $type, string $title, string $message, string $url = null): void
    {
        foreach ($class->students as $student) {
            AppNotification::create([
                'user_id' => $student->id,
                'type'    => $type,
                'title'   => $title,
                'message' => $message,
                'url'     => $url,
            ]);
        }
    }

    /**
     * Kirim notifikasi ke satu user tertentu.
     */
    public static function notifyUser(int $userId, string $type, string $title, string $message, string $url = null): void
    {
        AppNotification::create([
            'user_id' => $userId,
            'type'    => $type,
            'title'   => $title,
            'message' => $message,
            'url'     => $url,
        ]);
    }
}
