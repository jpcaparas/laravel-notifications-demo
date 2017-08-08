<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Notifications\ArrivedHome;
use App\User;
use Illuminate\Http\Request;

class NexmoController extends Controller
{
    function __invoke(Request $request, $userId)
    {
        $user = User::find($userId);

        if (empty($user) === true) {
            return response('No user with the ID ' . $userId . ' could be found');
        }

        try {
            $user->notify(new ArrivedHome());
        } catch (\Exception $e) {
           return response($e->getMessage());
        }

        return response('An SMS has been sent to: ' . $user->phone_mobile);
    }
}
