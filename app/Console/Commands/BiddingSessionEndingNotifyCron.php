<?php

namespace App\Console\Commands;

use App\Services\BiddingSessionNotificationService;
use Illuminate\Console\Command;

class BiddingSessionEndingNotifyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bidding_session_ending:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron send notifications about bidding endings and congratulation message';

    /**
     * Execute the console command.
     */
    public function handle(BiddingSessionNotificationService $service): void
    {
        echo "Running: $this->signature \n";

        $service->check();
    }
}
