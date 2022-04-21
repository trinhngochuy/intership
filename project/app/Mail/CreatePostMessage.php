<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CreatePostMessage extends Mailable
{
    use Queueable, SerializesModels;
    private $post;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$post)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.create-post',["user"=> $this->user,"post"=>$this->post]);
    }
}
