<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune --hours=48')->daily();
        $schedule->command('horizon:snapshot')->everyFiveMinutes();

        /**
         * Günde 2 sefer çalışıp oy verilen filmlerin ortalamasını hesaplar
         */
        $schedule->command('rate:calculate')->twiceDaily(12, 24);;
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
