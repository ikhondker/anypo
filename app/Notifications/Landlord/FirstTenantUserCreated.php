<?php

namespace App\Notifications\Landlord;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;

class FirstTenantUserCreated extends Notification  implements ShouldQueue
{
	

	use Queueable;
	protected $user;
	protected $random_password;
	protected $domain;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, String $random_password, $domain)
	{
		$this->user             = $user;
		$this->random_password  = $random_password;
		$this->domain             = $domain;
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
		//->subject('Admin User Credential for domain '.$this->domain->domain.' ')
		->subject('Welcome to '. $this->domain->domain .' - Application Admin Login Details')
		->greeting('Hello '.$this->user->name.',')
		->line('Welcome to '.config('app.name').'. Your site '. $this->domain->domain.' is ready to use. Please review this email in its entirety as it contains important information. Your Application Admin account has been created as follows:')
		->line('Email: '.$this->user->email.'.')
		->line('Password: '.$this->random_password)
		->line('Please use following link to login to your site:')
		->action('Login', 'https://'.$this->domain->domain.'/login')
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
