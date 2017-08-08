# Laravel Notifications Demo

A demo illustrating how Laravel notifications work through various channels (e.g. SMS, email, Slack, database).

## Installation

1. Clone this repo.
1. Run `composer install`.
1. Fill in values on the `.env` file and run `php artisan config:cache`.
1. Create a `database.sqlite` file under the `./database` directory.
1. Run `php artisan migrate --seed` to populate the database with dummy data.
1. Start testing routes listed on `php artisan route:list`.

## Notes

- For portability, I chose SQLite as the demo's default database.
- To test SMS capabilities, [sign up for an account (with free credits) on Nexmo](https://dashboard.nexmo.com/sign-up) and put the generated API credentials on `.env` file.
