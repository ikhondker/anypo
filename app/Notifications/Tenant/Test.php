<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Test extends Notification implements ShouldQueue
{
    use Queueable;

    private $details;
    /**
     * Create a new notification instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //return ['mail'];
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Test Notification from anypo.net')
            ->line($this->details['greeting'])
            ->line($this->details['body'])
            ->action($this->details['actionText'], $this->details['actionURL'])
            ;
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * IQBAL Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'entity'        => $this->details['entity'],
            'id'            => $this->details['id'],
            'from'          => $this->details['from'],
            'to'            => $this->details['to'],
            'subject'       => $this->details['subject'],
            'greeting'      => $this->details['greeting'],
            'body'          => $this->details['body'],
            'thanks'        => $this->details['thanks'],
            'actionText'    => $this->details['actionText'],
            'actionURL'     => $this->details['actionURL'],
        ];
    }

}
