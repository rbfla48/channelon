<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Http\Controllers\VideoListController;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->call(function(){
        //     $getVideodata = new VideoListController;
        //     //$getVideodata->getYoutubeVideo();
        //     $getVideodata->getChzzkVideo();
        // })->everyMinute();
        $schedule->call([VideoListController::class, 'getYoutubeVideo'])->everyMinute();
        $schedule->call([VideoListController::class, 'getChzzkVideo'])->everyMinute();
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
