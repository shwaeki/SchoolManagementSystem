<?php

namespace App\Console;

use App\Jobs\CheckTeacherAttendance;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
      //  $schedule->command("queue:work --daemon")->everyMinute()->withoutOverlapping();
        $schedule->job(new CheckTeacherAttendance())->dailyAt("09:00")->withoutOverlapping();
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
