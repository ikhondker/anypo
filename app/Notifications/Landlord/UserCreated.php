<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        UserCreated.php
 * @brief       This file contains the implementation of the UserCreated Notification.
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

class UserCreated extends Notification implements ShouldQueue
{
	use Queueable;
	protected $user;
	protected $random_password;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, String $random_password)
	{
		$this->user             = $user;
		$this->random_password  = $random_password;
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
					->subject('Welcome to '. config('app.name').' - Client Area Login Details')
					->greeting('Hello '. $this->user->name . ',')
					->line('Welcome to '. config('app.name') .'. Please review this email in its entirety as it contains important information.')
					->line(' Your client area login account has been created as follows:')
					->line('Email: '.$this->user->email)
					->line('Password: '.$this->random_password)
					->line('Please use following link to login:')
					->action('Login', url('/login'))
					->line('NOTE: We have sent a separate email for your email address verification. Please verify your email address before login.')
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
