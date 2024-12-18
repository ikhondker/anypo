<?php

namespace App\Notifications\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;

class UserRegistered extends Notification implements ShouldQueue
{
	use Queueable;

	protected $user;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
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
			->subject('Welcome to '. config('app.name'))
			->greeting('Hello '. $this->user->name . ',')
			->line('Welcome to '.config('app.name').' and thank you for the registration. You have registered with email: '.$this->user->email )
			->line('You will be receiving another email shortly to verify your email, with e-mail verification link.')
			->line('After verifying your email, you may use the following link to login:')
			->action('Login', url('/login'))
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
