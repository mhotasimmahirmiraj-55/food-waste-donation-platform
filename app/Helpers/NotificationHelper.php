<?php

namespace App\Helpers;

use App\Models\Notification;

class NotificationHelper
{
    /**
     * Send a notification to a user.
     */
    public static function send(int $userId, string $title, string $message): void
    {
        Notification::create([
            'user_id' => $userId,
            'title'   => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }
}
