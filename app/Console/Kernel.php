<?php

namespace App\Console;

use App\Models\Election;
use App\Services\ElectionRanking;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    
   protected function schedule(Schedule $schedule): void {
        $schedule->command('ranking:send')
                 ->everyMinute()
                 ->withoutOverlapping()
                 ->timezone('America/Fortaleza');
    }
        /**
         * ->everyTenMinutes();
         * ->everyFifteenMinutes();
         * ->everyThirtyMinutes();
         * ->everyMinute();
         * ->everyFiveMinutes();
         */
    /**
     * Register the commands for the application.
     */
    protected function commands(): void {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}