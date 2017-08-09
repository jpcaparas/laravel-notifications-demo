<?php

namespace App\Notifications;

use App\Traits\GetsTime;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ToEmail extends Notification
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = sprintf(
            '%1$s <%2$s> arrived home at %3$s.',
            $notifiable->name,
            $notifiable->email,
            $this->now()
        );

        return (new MailMessage)
                    ->subject('Laravel 5.4 notifications demo')
                    ->line($message);
    }
}
