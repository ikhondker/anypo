<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        TicketCreated.php
 * @brief       This file contains the implementation of the TicketCreated Notification.
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

		// $details = [
		// 	'entity'   		=> 'TICKET',
		// 	'id'            => $ticket_id,
		// 	'from'          => $owner->name,
		// 	'to'            => $owner->name,
		// 	'subject'       => 'FYI. Support Ticket #'. $ticket_id.' has been '.Str::lower($action).'.',
		// 	'greeting'      => 'Hi '.$owner->name.',',
		// 	'body'          => 'FYI, Support Ticket #'.$ticket_id.' has been '.Str::lower($action).'.',
		// 	'thanks'        => 'Thank you for using '. config('app.name').'!',
		// 	'actionText'    => 'View Document',
		// 	//'actionURL'   => route('advances.show', ['advance' => $wf->article_id]),
		// 	'actionURL'     => route('tickets.show',$ticket_id),
		// ];
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
					->subject('Ticket #'.$this->ticket->id.' has been created')
					->greeting('Hello, '.$this->user->name.',')
					->line('Ticket #'.$this->ticket->id.' for '.$this->ticket->title .' has been created. We will get back as soon we can.')
					->action('View Ticket', url('/tickets/'.$this->ticket->id))
					->line('Thank you for using our application!');
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
