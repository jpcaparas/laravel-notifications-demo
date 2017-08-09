<?php

namespace App\Notifications;

use App\Traits\GetsTime;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ToSlack extends Notification
{
    use GetsTime, Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $message = sprintf(
            '%1$s <%2$s> arrived home at %3$s.',
            $notifiable->name,
            $notifiable->email,
            $this->now()
        );

        return (new SlackMessage())
            ->success()
            ->content($message);
    }
}
