<?php

namespace Domain\Console;

use Illuminate\Console\Scheduling\Schedule;
use Domain\Console\Commands\GenerateSitemapCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        GenerateSitemapCommand::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(GenerateSitemapCommand::class)->dailyAt('00:10');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
