<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        UserRegistered.php
 * @brief       This file contains the implementation of the UserRegistered Notification.
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
namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;


class UserRegistered extends Notification implements ShouldQueue
{
	protected $user;
	use Queueable;

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
			->subject('Registration complete at '.config('app.name'))
			->greeting('Hello, '.$this->user->name)
			->line('Welcome to '.config('app.name').'.')
			->line('Thank you for the registration.')
			->line('You will be receiving another email shortly to verify your email with link')
			->line('Please click on that link to verify email Address')
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
