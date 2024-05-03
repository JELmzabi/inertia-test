<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DBNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $triggerBy = null, public $to = null, public $payload = null)
    {
        
    }


    public function via()
    {
        return ['database'];
    }

}