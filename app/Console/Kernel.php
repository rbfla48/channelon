<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Http\Controllers\VideoListController;
use App\Http\Controllers\StreamerListController;

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
        
        //동영상 수집
        $schedule->call([VideoListController::class, 'getYoutubeVideo'])->hourly();
        $schedule->call([VideoListController::class, 'getChzzkVideo'])->hourly();
        //채널정보 수집
        $schedule->call([StreamerListController::class, 'storeStreamerData'])->daily();
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
