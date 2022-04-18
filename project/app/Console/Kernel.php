<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Spatie\ShortSchedule\ShortSchedule;


class Kernel extends ConsoleKernel
{
    protected $commands = [
       Commands\InsertPortView::class
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
//    protected function schedule(Schedule $schedule)
//    {
//            $schedule->command('db:seed')->everyMinute();
//            $schedule->command('insert:view')->everyMinute();
//    }
protected function shortSchedule(ShortSchedule $schedule){
    $schedule->command('insert:view')->everySecond(50);
    $schedule->command('insert:like')->everySecond(50);
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
