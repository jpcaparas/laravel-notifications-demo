<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Notifications\ToEmail;
use App\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    function __invoke(Request $request, $userId)
    {
        $user = User::find($userId);

        if (empty($user) === true) {
            return response('No user with the ID ' . $userId . ' could be found');
        }

        try {
            $user->notify(new ToEmail());
        } catch (\Exception $e) {
           return response($e->getMessage());
        }

        return response('An email has been sent to: ' . $user->email);
    }
}
