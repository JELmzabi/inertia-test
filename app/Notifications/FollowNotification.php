<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

class FollowNotification extends DBNotification
{
    use Queueable;

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable)
    {
        return [
            "message" => "*{$this->triggerBy->name}* starting following you",
            // "to" => [
            //     "route" => "photos.show",
            //     "parameters" => [
            //         $this->photo->id
            //     ] 
            // ]
        ];
    }
}
