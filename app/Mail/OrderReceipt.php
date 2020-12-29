<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $settings;

    public $currency;


    public function __construct($order,$settings,$symbol)
    {
        $this->order = $order;
        
        $this->settings = $settings;

        $this->currency = $symbol;

    }

    
    public function build()
    {   
        return $this->subject('Ohram Order Confirmation')->view('emails.receipt.index');
    }
}
