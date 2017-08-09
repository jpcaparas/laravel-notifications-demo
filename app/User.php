<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App
 *
 * @property string name
 * @property string email
 * @property string password
 * @property string phone_mobile
 * @property boolean prefers_sms
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_mobile', 'prefers_sms'
    ];

    protected $casts = [
        'prefers_sms' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Route notifications for the Nexmo channel.
     *
     * @return string
     */
    public function routeNotificationForNexmo()
    {
        return $this->phone_mobile;
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @return string
     */
    public function routeNotificationForSlack()
    {
        // If no user web hook is defined, fall back to the system one
        return empty($this->slack_webhook_url) === false
            ? $this->slack_webhook_url
            : config('services.slack.webhook_url');
    }
}
