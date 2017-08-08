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

### DB notifications

1. Visit `http://[url]/notifications/db/[user-id]` and you should see this message:

    > A DB notification has been logged for [User]
    
1. Enter `artisan tinker` and run this command:

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

## Notes

- For portability, I chose SQLite as the demo's default database.
- To test SMS capabilities, [sign up for an account (with free credits) on Nexmo](https://dashboard.nexmo.com/sign-up) and put the generated API credentials on `.env` file.
