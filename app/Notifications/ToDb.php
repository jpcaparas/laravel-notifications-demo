<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * A notification stored in the database
 *
 * @package App\Notifications
 */
class ToDb extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  null|mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $notifiable->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ];
    }
}
