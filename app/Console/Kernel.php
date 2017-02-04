<?php

namespace App\Console;

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
        Commands\ResetCoinCron::class,
        Commands\LeaderboardCron::class,
        Commands\UniqueBidCron::class,
        Commands\ResetCron::class,
        Commands\LeaderboardCronOnce::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //$schedule->command('resetCoin:cron')
        //          ->cron('0 */2 * * * *');
        $schedule->command('reset:cron')
                  ->dailyAt('00:00');
        $schedule->command('leaderboard_once:cron')
                  ->dailyAt('00:00');

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
