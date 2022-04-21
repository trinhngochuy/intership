<?php

namespace App\Listeners;

use App\Events\CreatePost;
use App\Jobs\SendMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Bus;

class SendMailCreatePost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreatePost $event)
    {
 Bus::dispatch(new SendMailJob($event->post,$event->user));
    }
}
