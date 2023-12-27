<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Log;
use Request;

use App\Models\User;

class ReportError extends Notification implements ShouldQueue
{
    use Queueable;

    protected $entity;
    protected $subject='[ ERROR ] Error Report';

    protected $actionURL;
    protected $performer;
    protected $line='There has been an issue:'; 

    /**
     * Create a new notification instance.
     */
    public function __construct($entity,$subject)
    {
        $this->entity       = $entity;
        $this->actionURL    = Request::fullUrl();

        $this->subject  = '[ERROR] '. tenant('id').'/'.$this->entity .' : '.$subject;
        //$this->line     = ''
        //Log::debug("Inside system notification". Request::fullUrl() );
        $this->performer = User::where('id', auth()->user()->id )->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->greeting('Hi Team,')
            ->line($this->line)
            ->line('Tenant: '.tenant('id'))
            ->line('Entity: '.$this->entity)
            ->line('URL: '. $this->actionURL)
            ->line('Performer: '.$this->performer->name .'('.$this->performer->id.')')
            ->line('Timestamp: '.date('d-M-Y: h:i:s'))
            ->action('View Page', $this->actionURL)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $details = [
			'entity'   		=> 'PR',
			'id'            => $this->performer->id,
			'from'          => 'System',
			'to'            => 'System',
            'subject'       => $this->subject,
			'greeting'      => 'Hi Team,',
            'body'          => $this->line,
			'thanks'        => 'Thank you for using '. config('app.name').'!',
			'actionText'    => 'View PR',
			'actionURL'     => $this->actionURL,
		];

        return [
            'entity'        => $details['entity'],
            'id'            => $details['id'],
            'from'          => $details['from'],
            'to'            => $details['to'],
            'subject'       => $details['subject'],
            'greeting'      => $details['greeting'],
            'body'          => $details['body'],
            'thanks'        => $details['thanks'],
            'actionText'    => $details['actionText'],
            'actionURL'     => $details['actionURL'],
        ];
    }
}
