<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CallMeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    private $request;

    /**
     * Create a new message instance.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.callMe')->with([
            'email' => $this->request->get('email'),
            'content' => $this->request->get('content'),
        ])->subject('联系我 from my blog');
    }
}
