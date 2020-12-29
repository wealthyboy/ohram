<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AmbassadorStatusNotification extends Notification
{
    use Queueable;

    public $amb;

    public $request;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amb,$request)
    {
        $this->amb = $amb;

        $this->request =  $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('noreply@ohram.org', 'OHRAM')
                    ->subject($this->request->subject)
                    ->line('Dear '.$this->amb->full_name)
                    ->line($this->request->description)
                    ->line('Thank you  for joining us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
