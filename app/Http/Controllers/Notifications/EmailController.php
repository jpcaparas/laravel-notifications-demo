<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Notifications\ToEmail;
use App\Notifications\ToEmailAsync;
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
            $isAsync = (bool)$request->query('async');

            if ($isAsync === true) {
                $total = (int)$request->query('total') ?? 1;

                for ($current = 1; $current <= $total; $current++) {
                    $user->notify(new ToEmailAsync($current, $total));
                }
            } else {
                $user->notify(new ToEmail());
            }
        } catch (\Exception $e) {
           return response($e->getMessage());
        }

        return response('An email has been sent to: ' . $user->email);
    }
}
