<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Notifications\ToSlack;
use App\User;
use Illuminate\Http\Request;

class SlackController extends Controller
{
    function __invoke(Request $request, $userId)
    {
        $user = User::find($userId);

        if (empty($user) === true) {
            return response('No user with the ID ' . $userId . ' could be found');
        }

        try {
            $user->notify(new ToSlack());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return response('A Slack notification has been logged for ' . $user->name);
    }
}
