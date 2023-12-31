<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\SendEmailTest;
use Mail;

class SendEmailQueueJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $send_mail;

	/**
	 * Create a new job instance.
	 */
	public function __construct($send_mail)
	{
		 $this->send_mail = $send_mail;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$email = new SendEmailTest();
		Mail::to($this->send_mail)->send($email);

		//$email = new SendEmailTest();
		//Mail::to($this->details['email'])->send($email);
	}
}
