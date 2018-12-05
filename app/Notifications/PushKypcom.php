<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage; //for push
use NotificationChannels\WebPush\WebPushChannel; //for push
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PushKypcom extends Notification
{
    use Queueable;

     public $titulo="";
    public  $cuerpo="";


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title,$body)
    {
        //
       $this->titulo=$title;
       $this->cuerpo=$body;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

     public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->titulo)
            ->icon('assets/icons/icon-72x72.png')
            ->body($this->cuerpo);
    }
   /*public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
