<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        InvoiceCreated.php
 * @brief       This file contains the implementation of the InvoiceCreated Notification.
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
use App\Models\Landlord\Invoice;


class InvoiceCreated extends Notification implements ShouldQueue
{
	use Queueable;

	protected $user, $invoice;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, Invoice $invoice)
	{
		$this->user = $user;
		$this->invoice = $invoice;
		//$this->invoice_id = $invoice_id;
		//$this->invoice = Invoice::where('id', $invoice_id)->first();
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
					->subject(config('app.name'). ' Customer Invoice#'.$this->invoice->id)
					->greeting('Hello '. $this->user->name) . ','
					->line('This is a notice that Invoice#'.$this->invoice->id.' for '.config('app.name').' account has been generated.')
					->line('Please use following link to View Invoice:')
					->action('View Invoice', url('/online/'.$this->invoice->invoice_no))
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
