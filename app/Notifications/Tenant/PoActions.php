<?php

namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Tenant\Po;

use Str;

use Illuminate\Support\Facades\Log;

use App\Enum\WflActionEnum;

class PoActions extends Notification implements ShouldQueue
{
	use Queueable;

	protected $user;
	protected $po;
	protected $action;
	protected $actionURL;

	protected $subject	= 'Subject';
	protected $line		= 'Line Description';

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, Po $po, $action, $actionURL)
	{
		$this->user		= $user;
		$this->po		= $po;
		$this->action	= $action;
		$this->actionURL= $actionURL;

		switch ($this->action) {
			case WflActionEnum::SUBMITTED->value:
				$this->subject	= '[FYI] PO #'.$this->po->id.' '. $this->po->summary .' for '. number_format($this->po->amount, 2).$this->po->currency.' has been '.Str::lower($this->action).'.';
				$this->line		= 'Purchase Order #'.$this->po->id.' for '.$this->po->summary .' has been '.Str::lower($this->action).' for approval.';
				break;
			case WflActionEnum::PENDING->value:
				$this->subject	= '[Action Required] PO #'.$this->po->id.' '. $this->po->summary .' for '. number_format($this->po->amount, 2).$this->po->currency.' requires your approval.';
				$this->line		= 'Purchase Order #'.$this->po->id.' for '.$this->po->summary .' requires your approval.';
				break;
			case WflActionEnum::REJECTED->value:
				$this->subject	= '[FYI] PO #'.$this->po->id.' '. $this->po->summary .' for '. number_format($this->po->amount, 2).$this->po->currency.' has been '.Str::lower($this->action).'.';
				$this->line		= 'Purchase Order #'.$this->po->id.' for '.$this->po->summary .' has been '.Str::lower($this->action).'.';
				break;
			case WflActionEnum::APPROVED->value:
				$this->subject	= '[FYI] PO #'.$this->po->id.' '. $this->po->summary .' for '. number_format($this->po->amount, 2).$this->po->currency.' has been '.Str::lower($this->action).'.';
				$this->line		= 'Purchase Order #'.$this->po->id.' for '.$this->po->summary .' has been '.Str::lower($this->action).'.';
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
		return ['mail','database'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage
	{
		return (new MailMessage)
			->subject($this->subject)
			->greeting('Hello, '.$this->user->name)
			->line($this->line)
			->action('View Purchase Order', $this->actionURL)
			//->action('View Order', url('prs', [ $this->po->id ]))
			//->action('View PR', route('prs.show',$this->po->id))
			//->action('View Order', route('prs.show',['po' => $this->po->id] ))
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


	/**
	 * IQBAL Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toDatabase($notifiable)
	{


		$details = [
			'entity'		=> 'PO',
			'id'			=> $this->user->id,
			//'from'		=> $this->user->name,	// TODO P2
			'from'			=> 'Workflow',
			'to'			=> $this->user->name,
			'subject'		=> $this->subject,
			'greeting'		=> 'Hi '.$this->user->name.',',
			'body'			=> $this->line,
			'thanks'		=> 'Thank you for using '. config('app.name').'!',
			'actionText'	=> 'View Purchase Order',
			'actionURL'		=> $this->actionURL,
		];

		return [
			'entity'		=> $details['entity'],
			'id'			=> $details['id'],
			'from'			=> $details['from'],
			'to'			=> $details['to'],
			'subject'		=> $details['subject'],
			'greeting'		=> $details['greeting'],
			'body'			=> $details['body'],
			'thanks'		=> $details['thanks'],
			'actionText'	=> $details['actionText'],
			'actionURL'		=> $details['actionURL'],
		];
	}
}
