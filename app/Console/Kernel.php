<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Jobs\Landlord\Billing;

class Kernel extends ConsoleKernel
{
	/**
	 * Define the application's command schedule.
	 */
	protected function schedule(Schedule $schedule): void
	{
		// $schedule->command('inspire')->hourly();

		//->everyFiveMinutes()
		$schedule->job(new Billing)
			->everyMinute()	
			->appendOutputTo("scheduler-output.log")
			->withoutOverlapping();

		// ->runInBackground();
		// $schedule->command('billing:cron')
		// 	->everyFiveMinutes()
		// 	->appendOutputTo("scheduler-output.log")
		// 	->runInBackground();	
	}

	/**
	 * Register the commands for the application.
	 */
	protected function commands(): void
	{
		$this->load(__DIR__.'/Commands');

		require base_path('routes/console.php');
	}
}
