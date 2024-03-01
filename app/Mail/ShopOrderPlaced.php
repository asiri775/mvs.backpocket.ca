<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShopOrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $name;
    public $subject;
    public $template;
    public $button;

    /**
     * Create a new message instance.555555555555555
     *
     * @return void
     */
    public function __construct($first_name,$order, $subject, $template)
    {
        $this->first_name = $first_name;
        $this->order = $order;
        $this->subject = "Protectica Order#".$order->id." – Thank You!"; 
        $this->template = $template;
        $this->button = url('shop-order-details')."/".$order->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.orders.shopPlaced');
    }
}
