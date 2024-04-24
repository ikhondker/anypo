<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use Str;


class NotifyAdmin extends Notification implements ShouldQueue
{
	use Queueable;

	protected $user;
	protected $action;
	protected $article_id;

	protected $subject='Subject';
	protected $line1='Line Description';
	protected $line2='Line Description';

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, $action, $id)
	{
		$this->user			= $user;
		$this->action		= $action;
		$this->article_id	= $id;

		switch ($this->action) {
			case 'USER-REGISTERED':
				$tenantUser = User::where('id', $this->article_id)->first();
				$this->subject = '[FYA] New User Registration: '. $tenantUser->name;
				$this->line1	= 'Please note, a new user your '. $tenantUser->name.' has been registered at '.tenant('id').'.' .config('app.name').' with email '.$tenantUser->email;  ;
				$this->line2	= 'Please review and enable that account, if it is a valid team member.';
				break;
			case 'XXACTIVATED':
				

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
			->greeting('Hello '. $this->user->name . ',')
			->line($this->line1)
			->line($this->line2)
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
