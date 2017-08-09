<?php

namespace App\Notifications;

use App\Traits\GetsTime;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class ToNexmo extends Notification
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
        return $notifiable->phone_mobile ? ['nexmo'] : [];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $message = sprintf(
          '%1$s <%2$s> arrived home at %3$s.',
          $notifiable->name,
          $notifiable->email,
          $this->now()
        );

        return (new NexmoMessage)
            ->content($message)
            ->from(config('services.nexmo.sms_from'));
    }
}
