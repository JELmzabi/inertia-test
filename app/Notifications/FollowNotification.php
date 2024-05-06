<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;

class FollowNotification extends DBNotification
{
    use Queueable;

    public function via()
    {
        return ['database', 'broadcast'];
    }

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

    public function broadcastOn(){
        return ['notifications'];
    }

    public function broadcastAs(){
        return "follow";
    }
    
    public function toBroadcast() {
        return new BroadcastMessage([
            'id' => $this->id,
            'data' => [
                'message' => "**{$this->triggerBy->name}** starting following you",
            ],
            'to' => $this->to,
            'payload' => $this->payload,
            'triggerBy' => $this->triggerBy,
        ]);
    }
}
