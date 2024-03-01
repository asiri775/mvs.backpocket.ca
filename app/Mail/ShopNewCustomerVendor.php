<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShopNewCustomerVendor extends Mailable
{
    use Queueable, SerializesModels;

    public $template;
    public $subject;
//    public $button;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $template)
    {
        $this->template = $template;
        $this->subject = $subject;
        //$this->button = "<a href='" . route('vendor.dashboard') . "' target='_blank'>Dashboard</a>";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.registration.shopNewCustomer');
    }
}
