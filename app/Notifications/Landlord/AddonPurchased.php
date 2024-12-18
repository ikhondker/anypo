<?php

namespace App\Notifications\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Landlord\Account;

class AddonPurchased extends Notification implements ShouldQueue
{
	use Queueable;
	protected $user, $account;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, Account $account)
	{
		$this->user = $user;
		$this->account = $account;
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
			->subject('Add-on added for Account#'.$this->account->id.'')
			->greeting('Hello, '.$this->user->name)
			->line('Addon has been added into Account#'.$this->account->id.' for site '.$this->account->site .'.')
			->action('View Account', url('/accounts'))
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
