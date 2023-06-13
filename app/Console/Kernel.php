<?php

namespace App\Console;

use App\Models\Election;
use App\Services\SendRanking;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void {
        $election = Election::where('active', 1)->first();

        $schedule->call(new SendRanking($election))
                    ->everyThirtyMinutes()
                    ->between('8:30', '12:30');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
