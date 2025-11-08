<?php

namespace App\Listeners;

use App\Events\ChildRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewChildNotification
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
    public function handle(ChildRegistered $event): void
    {
        $child = $event->child;
        $user = $child->users()->first();

    }
}
