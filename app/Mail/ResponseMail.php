<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function build()
    {
        return $this->view('emails.response')
                    ->with([
                        'response' => $this->response,
                    ]);
    }
}
