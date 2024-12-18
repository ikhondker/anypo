<?php

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
		//->line('Subject: '.$this->contact->subject)
		//->line('Hi: '.$this->contact->first_name)

		return (new MailMessage)
			->subject($this->contact->subject)
			->greeting('Hello, '.$this->contact->first_name)
			->line('Thanks. We have received the following:')
			->line('From: '.$this->contact->first_name.' '.$this->contact->last_name)
			->line('Email: '.$this->contact->email)
			->line('Cell: '.$this->contact->cell)
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
