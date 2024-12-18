<?php

namespace App\Notifications\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Landlord\Ticket;


class TicketCreated extends Notification implements ShouldQueue
{
	use Queueable;
	protected $user, $ticket;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, Ticket $ticket)
	{
		$this->user = $user;
		$this->ticket = $ticket;

		//$this->details = $details;

		//$ticket = Ticket::where('id',$ticket_id)->first();
		// find owner to notify
		//$owner = User::where('id', $ticket->owner_id)->first();


	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function via(object $notifiable): array
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage
	{
		return (new MailMessage)
			->subject(config('app.name'). ' - Ticket #'.$this->ticket->id.' has been created')
			->greeting('Hello '.$this->user->name.',')
			->line('Ticket #'.$this->ticket->id.' for '.$this->ticket->title .' has been created. We will get back as soon we can.')
			->action('View Ticket', url('/tickets/'.$this->ticket->id))
			->line('Thank you for using '.config('app.name').' application!');
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
			'entity'	=> $this->details['entity'],
			'id'		=> $this->details['id'],
			'from'		=> $this->details['from'],
			'to'		=> $this->details['to'],
			'subject'	=> $this->details['subject'],
			'greeting'	=> $this->details['greeting'],
			'body'		=> $this->details['body'],
			'thanks'	=> $this->details['thanks'],
			'actionText'=> $this->details['actionText'],
			'actionURL'	=> $this->details['actionURL'],
		];
	}
}
