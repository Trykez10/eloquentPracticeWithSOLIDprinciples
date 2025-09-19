<?php

namespace App\Listeners;

use App\Events\ProcessUpdateTask;
use App\Mail\UpdatePostMail;
use Carbon\Traits\ToStringFormat;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        $email = $posts->user->email;

        Mail::to($email)->send(new UpdatePostMail($posts, $upd));
    }
}
