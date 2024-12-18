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

		//->appendOutputTo('scheduler-output.log')
		//->everyFiveMinutes()
		//->appendOutputTo(storage_path('logs/scheduler-output.log'))
		//->everyMinute();
		//->dailyAt('13:00')

		$schedule->job(new Billing)
			->everyMinute()
			->withoutOverlapping();
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
