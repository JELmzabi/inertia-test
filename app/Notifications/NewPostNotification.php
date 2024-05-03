<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

class NewPostNotification extends DBNotification
{
    use Queueable;

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(): Array
    {
        return [
            "message" => "**{$this->triggerBy->name}** _Post_ a new photo",

        ];
    }
}
