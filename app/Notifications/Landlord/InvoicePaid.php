<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        InvoicePaid.php
 * @brief       This file contains the implementation of the InvoicePaid Notification.
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
use App\Models\Landlord\Payment;

class InvoicePaid extends Notification implements ShouldQueue
{
	use Queueable;
	protected $user, $invoice, $payment;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user,Invoice $invoice, Payment $payment)
	{
		$this->user = $user;
		$this->invoice = $invoice;
		$this->payment = $payment;
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
					->subject(config('app.name'). ' Invoice #'.$this->invoice->invoice_no.' has been paid')
					->greeting('Hello '.$this->user->name.',')
					->line('This is a notice that Invoice#'.$this->invoice->invoice_no.' has been paid.')
					->line(' Payment ID# '.$this->payment->id)
					->line('Please use following link to View Payment:')
					->action('View Payment', url('/payments/'.$this->payment->id))
					->line('NOTE: You may download the receipt after logging into your account.')
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
