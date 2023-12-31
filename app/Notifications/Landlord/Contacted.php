<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        Contacted.php
 * @brief       This file contains the implementation of the Contacted Notification.
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

use App\Models\Landlord\Manage\Contact;
use App\Models\User;

class Contacted extends Notification implements ShouldQueue
{
	use Queueable;
	protected $contact;
	/**
	 * Create a new notification instance.
	 */
	public function __construct(Contact $contact)
	{
		$this->contact = $contact;
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
				->subject('Website Contact: '.$this->contact->subject)
				->line('Hi: '.$this->contact->name)
				->line('Thanks. We have received the following:')
				->line('From: '.$this->contact->name)
				->line('Subject: '.$this->contact->subject)
				->line('Email: '.$this->contact->email)
				->line('Message : '.$this->contact->message)
				->line('Timestamp: '.now().'.')
				->line('We will connect soon.')
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
