# Laravel Notifications Demo

A demo illustrating how [Laravel notifications](https://laravel.com/docs/5.4/notifications) work through various channels (e.g. SMS, email, Slack, database).

## Installation

1. Clone this repo.
1. Run `composer install`.
1. Fill in values on the `.env` file and run `php artisan config:cache`.
1. Create a `database.sqlite` file under the `./database` directory.
1. Run `php artisan migrate --seed` to populate the database with dummy data.
1. Start testing routes listed on `php artisan route:list`.

## Testing

### SMS (via Nexmo) notifications

1. [Sign up for an account (with free credits) on Nexmo](https://dashboard.nexmo.com/sign-up) to generate values for `NEXMO_*` directives on the `.env` file.

1. Run `php artisan config:cache`.

1. Run `php artisan tinker` and issue the following commands:

    > `$user = App\User::find([user-id])`
    
    > `$user->phone_mobile = [your-mobile-phone-number-with-country-code]`
    
    > `$user->prefers_sms = true`
    
    > `$user->save()`

1. Visit `http://[url]/notifications/nexmo/[user-id-you-entered-previously]` and you should see this message:
   
    > An SMS has been sent to [User]
    
1. You should receive an SMS like the one below:

    ```
    [User] <[user-email]> arrived home at 2017-08-08 21:34:18.[FREE SMS DEMO, TEST MESSAGE]
    ```

---

### Email notifications

1. [Sign up for a free Mailtrap account](https://mailtrap.io/register/signup?header) to generate values for `MAIL_*` directives on the `.env` file.

    Note: You can choose your own email provider, but for this demo, we're going with Mailtrap, because it's the default provider shipped with Laravel 5.4.
    
1. Run `php artisan config:cache`.

1. Run `php artisan tinker` and issue the following commands:

    > `$user = App\User::find([user-id])`
    
    > `$user->email = [your-email]`
    
    > `$user->save()`
    
1. Visit `http://[url]/notifications/email/[user-id-you-entered-previously]` and you should see this message:
   
    > An email has been sent to [User]
    
1. An email will be sent to the intended recipient:

    ![email-notification](http://i.imgur.com/K2NiQC9l.jpg)

---

### DB notifications

1. Visit `http://[url]/notifications/db/[user-id]` and you should see this message:

    > A DB notification has been logged for [User]
    
1. Run `artisan tinker` and issue this command:

    > `\App\User::find([user-id-you-entered-previously])->notifications`

1. You should see something similar to the below response, confirming that the notification has been logged to the database:
    
    ```
    Illuminate\Notifications\DatabaseNotificationCollection {#697
       all: [
         Illuminate\Notifications\DatabaseNotification {#690
           id: "add9130d-0d66-4559-b213-ee392d1cbe79",
           type: "App\Notifications\ToDb",
           notifiable_id: "1",
           notifiable_type: "App\User",
           data: "{"user_id":1,"ip":"127.0.0.1","user_agent":"Mozilla\/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36"}",
           read_at: null,
           created_at: "2017-08-08 21:53:52",
           updated_at: "2017-08-08 21:53:52",
         },
       ],
     }
     ```

---

### Slack notifications

1. [Generate a webhook](https://api.slack.com/incoming-webhooks) for the `SLACK_WEBHOOK_URL` directive on the `.env` file.

    Note: Webhook URLs can be defined on a per-user basis. Simply define it on the `slack_webhook_url` property of a `User` record.
    
1. Run `php artisan config:cache`.

1. Visit `http://[url]/notifications/slack/[user-id]` and you should see this message:
   
    > A Slack notification has been logged for [User]
    
1. The webhook will send a message to the specified recipient, which might be either a user or channel. Look for this type of notification:

    ![slack-notification](http://i.imgur.com/RTJwLdkl.jpg)

## Notes

- For portability, I chose SQLite as the demo's default database. No one likes to set up a full-on MySQL database for a simple demo.
- Nexmo SMS charges vary country-to-country. If you find yourself running out of credits during the demo, try upgrading to their paid tier or attempt to create a new account.

## TODO

Ideas and feature suggestions can be added to the _Backlog_ column on the _Ideas_ [project board](https://github.com/jpcaparas/laravel-notifications-demo/projects/1). I'll try to action them when I have the time.

## Attributions

This wouldn't be possible without being granted a role as Software Developer at [Pixel Fusion](https://pixelfusion.co.nz/), an award-winning product development company at Parnell, Auckland.
