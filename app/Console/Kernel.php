<?php

namespace App\Console;

use App\Console\Commands\GenerateDailyWords;
use App\Console\Commands\UpdateRating;
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
        UpdateRating::class,
        GenerateDailyWords::class
    ];

    /**
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('rating:update')
            ->everyThirtyMinutes();
        $schedule->command('dailywords:generate')
            ->cron('0 0 * * *');
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
