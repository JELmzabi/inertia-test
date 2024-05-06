<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TestNotification extends DBNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable)
    {
        return [
            'message' => 'test broadcast notification'
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            'message' => 'test broadcast notification'
        ]);
    }
}
