<?php

namespace Domain\Console;

use Illuminate\Console\Scheduling\Schedule;
use Domain\Console\Commands\GenerateSitemapCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * @var array
     */
    protected $commands = [
        GenerateSitemapCommand::class,
    ];

    /**
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(GenerateSitemapCommand::class)->dailyAt('00:10');
    }

    /**
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
