<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use Str;

class UserActions extends Notification implements ShouldQueue
{
	protected $user;
	protected $action;
	protected $actionURL;

	protected $subject='Subject';
	protected $line1='Line Description';
	protected $line2='Line Description';

	use Queueable;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, $action, $actionURL)
	{
		$this->user     = $user;
		$this->action   = $action;
		$this->actionURL   = $actionURL;

		switch ($this->action) {
			case 'ACTIVATED':
				$this->subject  = '[FYA] Your '.config('app.name').' account at has been '.Str::lower($this->action).'.';
				$this->line1     = 'Please note, your '.config('app.name').' account at has been '.Str::lower($this->action).'.';
				$this->line2     = 'Please use this as login email: '.$this->user->email;
				break;
			default:
				// Success 
		}
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
			->subject($this->subject)
			->greeting('Hello, '.$this->user->name)
			->line($this->line1)
			->line($this->line2)
			->action('Login', $this->actionURL)
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
