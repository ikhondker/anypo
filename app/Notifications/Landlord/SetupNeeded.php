<?php

namespace App\Notifications\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Landlord\Account;

class SetupNeeded extends Notification implements ShouldQueue
{
	use Queueable;

	protected $user, $account;
	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, Account $account)
	{
		$this->user		= $user;
		$this->account	= $account;
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
			->subject(config('app.name'). ' - Installation Service Needed')
			->greeting('Hello '.$this->user->name.',')
			->line('This new purchase require Installation service. Please take action: ')
			->line('Name: '.$this->account->name)
			->line('Account ID: '.$this->account->id)
			->action('View Account', url('/accounts'))
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
