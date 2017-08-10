<?php

namespace App\Notifications;

use App\Traits\GetsTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Async email notifications
 *
 * @package App\Notifications
 */
class ToEmailAsync extends Notification implements ShouldQueue
{
    use GetsTime, Queueable;

    /**
     * @var int
     */
    private $current;

    /**
     * @var int
     */
    private $total;

    /**
     * ToEmailAsync constructor.
     *
     * @param int $current Current notification
     * @param int $total Total number of notifications
     */
    public function __construct(int $current, int $total)
    {
        $this->setCurrent($current);
        $this->setTotal($total);
    }

    /**
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }

    /**
     * @param int $current
     */
    public function setCurrent(int $current)
    {
        $this->current = $current;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total)
    {
        $this->total = $total;
    }

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
        $subject = sprintf(
            '[ASYNC] [%1$s of %2$s] Laravel 5.4 notifications demo',
            $this->getCurrent(),
            $this->getTotal()
        );

        $message = sprintf(
            '%1$s <%2$s> arrived home at %3$s.',
            $notifiable->name,
            $notifiable->email,
            $this->now()
        );

        return (new MailMessage)
                    ->subject($subject)
                    ->line($message);
    }
}
