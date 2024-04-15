<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        ServicePurchased.php
 * @brief       This file contains the implementation of the ServicePurchased Notification.
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

class ServicePurchased extends Notification implements ShouldQueue
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
			->subject(config('app.name'). 'Service purchase Notification')
			->greeting('Hello '.$this->user->name.',')
			->line('A new purchase has been made as follows: ')
			->line('Name: '.$this->account->name)
			->line('ID: '.$this->account->id)
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
