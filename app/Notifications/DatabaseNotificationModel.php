<?php

namespace App\Notifications;

use Illuminate\Notifications\DatabaseNotification;

class DatabaseNotificationModel extends DatabaseNotification
{

    protected $appends = ['time_ago'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'payload' => 'array'
    ];

    public function getTimeAgoAttribute() {
        return $this->created_at->diffForHumans();
    }
}
