<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $subject, $template)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.quoterequest')
            ->with('template',  $this->template)
            ->with('info', $this->data);
    }
}
