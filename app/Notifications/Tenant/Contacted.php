<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Contact;
use App\Models\User;

class Contacted extends Notification implements ShouldQueue
{
	use Queueable;

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
