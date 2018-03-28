<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data instance.
     *
     * @var data
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Blog Contact Form: ' . $this->data['name'])
                ->replyTo($this->data['email'])
                ->view('emails.contact')
                ->with($this->data);
    }
}
