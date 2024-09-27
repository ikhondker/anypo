<?php

namespace App\Notifications\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Landlord\Admin\Invoice;


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
			->subject(config('app.name'). ' - Invoice #'.$this->invoice->invoice_no)
			->greeting('Hello '. $this->user->name . ',')
			->line('This is a notice that an Invoice#'.$this->invoice->invoice_no.' for '.config('app.name').' for your account has been generated.')
			->line('Please use the following link to View Invoice:')
			->action('View Invoice', url('/online/'.$this->invoice->invoice_no))
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
			'entity'		=> $this->details['entity'],
			'id'			=> $this->details['id'],
			'from'			=> $this->details['from'],
			'to'			=> $this->details['to'],
			'subject'		=> $this->details['subject'],
			'greeting'		=> $this->details['greeting'],
			'body'			=> $this->details['body'],
			'thanks'		=> $this->details['thanks'],
			'actionText'	=> $this->details['actionText'],
			'actionURL'		=> $this->details['actionURL'],
		];
	}
}
