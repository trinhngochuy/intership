<?php

namespace App\Jobs;

use App\Mail\CreatePostMessage;
use http\Client\Curl\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
public $post;
public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post,$user)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to("test@gmail.com.vn")->send(new CreatePostMessage($this->user,$this->post));
    }
}
