<?php

namespace App\Domains\Users\Listeners;

use App\Domains\Users\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class PublishUserDataToNotificationService implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {

    }
}
