<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cart;

class AbandonedCart extends Mailable
{
    use Queueable, SerializesModels;

    public $carts;

    public function __construct($carts)
    {
        $this->carts = $carts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->subject('Complete your order')->view('emails.carts.index');
    }
}
