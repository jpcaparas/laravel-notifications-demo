<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First user
        $user = new \App\User();
        $user->name = 'JP Caparas';
        $user->password = 'secret';
        $user->email = 'jp@jpcaparas.com';
        $user->phone_mobile = '+64273731386';
        $user->prefers_sms = true;
        $user->slack_webhook_url = '';
        $user->save();

        // Rest of users
        factory(App\User::class, 50)->create();
    }
}
