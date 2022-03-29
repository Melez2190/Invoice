<?php

namespace App\Console;

use App\Console\Commands\DailyMessage;
use App\Console\Commands\NotificationMessage;
use App\Jobs\SendEmailNotificationInvoice;
use App\Models\Invoice;
use App\Notifications\SchedulerNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\NotificationMessage::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('mailto:notpaid')->monthlyOn(2, '13:00')->timezone('Europe/Belgrade'); //->runInBackground()
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
