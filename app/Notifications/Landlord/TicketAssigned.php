<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        TicketAssigned.php
 * @brief       This file contains the implementation of the TicketAssigned Notification.
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

use Illuminate\Database\Eloquent\Builder;
use App\Enum\LandlordTicketStatusEnum;

use App\Models\User;
use App\Models\Landlord\Ticket;


class TicketAssigned extends Notification implements ShouldQueue
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
			->subject('Ticket #'.$this->ticket->id.' assigned to you')
			->greeting('Hello, '.$this->user->name)
			->line('Ticket #'.$this->ticket->id.' for '.$this->ticket->title .' has been assigned to you.')
			->action('View Ticket', url('/tickets/'. $this->ticket->id))
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
}
