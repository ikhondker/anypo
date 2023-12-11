<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        Test.php
 * @brief       This file contains the implementation of the Test Notification.
 * @author      Iqbal H. Khondker 
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
*/
namespace App\Notifications\Landlord;

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
        //return ['database'];
        //return ['mail'];
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('[TEST] Welcome to '. config('app.name').' - '. now())
					->greeting('Hello Iqbal,')
					->line('Welcome to '.config('app.name').'. Please review this email in its entirety as it contains important information.')
					->line(' Your client area login account has been created as follows:')
					//->line('Email: '.$this->user->email.'.')
					//->line('Password: '.$this->random_password)
					->line('')
					->line('Please use following link to login:')
					->action('Login', url('/login'))
					->line('NOTE: We have sent a separate email for your email address verification. Please verify your email address before login.')
					->line('Thank you for using our application!');

            // ->line($this->details['greeting'])
            // ->line($this->details['body'])
            // ->action($this->details['actionText'], $this->details['actionURL']);
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
