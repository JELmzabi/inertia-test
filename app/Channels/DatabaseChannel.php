<?php
 
namespace App\Channels;
 
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;
 
class DatabaseChannel extends IlluminateDatabaseChannel
{
    /**
    * Send the given notification.
    *
    * @param mixed $notifiable : the model to be notified
    * @param \Illuminate\Notifications\Notification $notification
    * @param mixed $triggerBy : the model responsible for triggering the notification.
    * @return \Illuminate\Database\Eloquent\Model
    */
    public function send($notifiable, Notification $notification)
    {
        return $notifiable->routeNotificationFor('database')->create(
            $this->buildCustomPayload($notifiable, $notification)
        );
    }

    /**
     * Build an array payload for the DatabaseNotification Model.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @param mixed $triggerBy : the model responsible for triggering the notification.
     * @return array
     */
    protected function buildCustomPayload($notifiable, Notification $notification)
    {
        return [
            'id' => $notification->id,
            'type' => method_exists($notification, 'databaseType')
                        ? $notification->databaseType($notifiable)
                        : get_class($notification),
            'data' => $this->getData($notifiable, $notification),
            'triggerBy_id' => $notification->triggerBy?->id,
            'triggerBy_type' => $notification->triggerBy ? get_class($notification->triggerBy) : null,
            'to' => $notification->to,
            'payload' => json_encode($notification->payload),
            'read_at' => null,
        ];
    }
}