<?php
namespace App\Notifications\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Tenant\Pr;

use Str;

use Illuminate\Support\Facades\Log;

use App\Enum\WflActionEnum;

class PrActions extends Notification implements ShouldQueue
{
	use Queueable;

	protected $user;
	protected $pr;
	protected $action;
	protected $actionURL;

	protected $subject 	='Subject';
	protected $line 	='Line Description'; 

	/**
	 * Create a new notification instance.
	 */
	public function __construct(User $user, Pr $pr, $action, $actionURL)
	{
		$this->user		= $user;
		$this->pr		= $pr;
		$this->action	= $action;
		$this->actionURL= $actionURL;
		//$this->details= $details;

		//Log::debug("user_id = ".$this->user->id );
		//Log::debug("pr_id = ".$this->pr->id );
		//Log::debug("action = ".$this->action );

		switch ($this->action) {
			case WflActionEnum::SUBMITTED->value:
				$this->subject	= '[FYI] PR #'.$this->pr->id.' '. $this->pr->summary .' for '. number_format($this->pr->amount, 2).$this->pr->currency.' has been '.Str::lower($this->action).'.';
				$this->line		= 'Purchase Requisition #'.$this->pr->id.' for '.$this->pr->summary .' has been '.Str::lower($this->action).'.';
				break;
			case WflActionEnum::PENDING->value:
				$this->subject	= '[Action Required] PR #'.$this->pr->id.' '. $this->pr->summary .' for '. number_format($this->pr->amount, 2).$this->pr->currency.' requires your approval.';
				$this->line		= 'Purchase Requisition #'.$this->pr->id.' for '.$this->pr->summary .' requires your approval.';
				break;
			case WflActionEnum::REJECTED->value:
				$this->subject	= '[FYI] PR #'.$this->pr->id.' '. $this->pr->summary .' for '. number_format($this->pr->amount, 2).$this->pr->currency.' has been '.Str::lower($this->action).'.';
				$this->line		= 'Purchase Requisition #'.$this->pr->id.' for '.$this->pr->summary .' has been '.Str::lower($this->action).'.';
				break;
			case WflActionEnum::APPROVED->value:
				$this->subject	= '[FYI] PR #'.$this->pr->id.' '. $this->pr->summary .' for '. number_format($this->pr->amount, 2).$this->pr->currency.' has been '.Str::lower($this->action).'.';
				$this->line		= 'Purchase Requisition #'.$this->pr->id.' for '.$this->pr->summary .' has been '.Str::lower($this->action).'.';
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
		//return ['mail'];
		return ['mail','database'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage
	{

		// return (new MailMessage)
		//     ->subject('[FYI] PR #'.$this->pr->id.' '. $this->pr->summary .' for '. $this->pr->amount.$this->pr->currency.' has been '.Str::lower($this->action).'.')
		//     ->greeting('Hello, '.$this->user->name)
		//     ->line('Purchase Requisition #'.$this->pr->id.' for '.$this->pr->summary .' has been submitted for approval.')
		//     ->action('View PR', url('/prs/'.$this->pr->id))
		//     ->line('Thank you for using our application!');

		return (new MailMessage)
			->subject($this->subject)
			->greeting('Hello, '.$this->user->name)
			->line($this->line)
			->action('View Requisition', $this->actionURL)
			//->action('View Requisition', url('prs', [ $this->pr->id ]))
			//->action('View PR', route('prs.show',$this->pr->id))
			//->action('View Requisition', route('prs.show',['pr' => $this->pr->id] ))
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
			'entity'		=> 'PR',
			'id'			=> $this->user->id,
			'from'			=> $this->user->name,
			'to'			=> $this->user->name,
			//'subject'		=> '[FYI] PR #'.$this->pr->id.' '. $this->pr->summary .' for '. $this->pr->amount. $this->pr->currency.' has been '.Str::lower($this->action).'.',
			'subject'		=> $this->subject,
			'greeting'		=> 'Hi '.$this->user->name.',',
			//'body'		=> '[FYI] PR#'.$this->pr->id.' '. $this->pr->summary .' for '. $this->pr->amount. ' has been '.Str::lower($this->action).'.',
			'body'			=> $this->line,
			'thanks'		=> 'Thank you for using '. config('app.name').'!',
			'actionText'	=> 'View PR',
			//'actionURL'	=> route('advances.show', ['advance' => $wf->article_id]),
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
