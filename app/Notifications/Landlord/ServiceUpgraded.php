<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        ServiceUpgraded.php
 * @brief       This file contains the implementation of the ServiceUpgraded Notification.
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
use App\Models\Landlord\Account;

class ServiceUpgraded extends Notification implements ShouldQueue
{
	use Queueable;

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
			->subject('Service has been upgraded for Account#'.$this->account->id.'')
			->greeting('Hello, '.$this->user->name)
			->line('Your Service in  Account#'.$this->account->id.' for site '.$this->account->site .' has been upgraded.')
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
