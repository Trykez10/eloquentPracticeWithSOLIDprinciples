<?php

namespace App\Listeners;

use App\Events\ProcessUpdateTask;
use Carbon\Traits\ToStringFormat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUpdateMessage
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
    public function handle(ProcessUpdateTask $event): void
    {
        $posts = $event->data;
        $upd = $event->updates;


        echo "From Email: Your post " . $posts->title . " has been updated to " . implode($upd) . "\n";
    }
}
