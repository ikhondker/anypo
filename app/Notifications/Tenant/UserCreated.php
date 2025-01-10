<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Helpers\Tenant\Akk;

class UserCreated extends Notification implements ShouldQueue
{

	protected $user;
	protected $random_password;
	use Queueable;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user,String $random_password)
	{
		$this->user = $user;
		$this->random_password = $random_password;
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
		->subject('Welcome to '.Akk::getDomainName())
			->greeting('Hello '. $this->user->name . ',')
			->line('Welcome to '.tenant('id').'.'.config('app.name').' Your account has been created as follows: ' )
			->line('Email: '.$this->user->email.'.')
			->line('Password: '.$this->random_password)
			->line('Please use following link to login.')
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
