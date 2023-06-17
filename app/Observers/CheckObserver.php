<?php

namespace App\Observers;

use App\Models\Check;
use App\Notifications\EndpointDownNotification;

class CheckObserver
{
    /**
     * Handle the Checker "created" event.
     */
    public function created(Check $check): void
    {
        if (!$check->isSuccess())
        {
            $user = $check->endpoint->site->user;
            $user->notify(new EndpointDownNotification($check));
        }
    }
}
