<?php

namespace App\Notifications\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


use App\Models\User;
use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;

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
		//->line('You may also download the PDf receipt after logging into your account.')
		return (new MailMessage)
			->subject(config('app.name'). ' Invoice #'.$this->invoice->invoice_no.' has been paid')
			->greeting('Hello '.$this->user->name.',')
			->line('This is a notice that your Invoice #'.$this->invoice->invoice_no.' has been paid.')
			->line('Payment Ref #'.$this->payment->id)
			->line('Please use following link to View Payment:')
			->action('View Payment', url('/payments/'.$this->payment->id))
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
}
