<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsLetterEmail extends Mailable
{
    use Queueable, SerializesModels;
    

    public $template;

    public $subject;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template,$subject)
    {
        $this->template = $template;

        $this->subject = $subject;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@ohram.org')
                    ->subject($this->subject)
                    ->view('emails.newsletter.index');
    }
}
