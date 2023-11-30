<?php

namespace App\Console\Commands;

use App\Services\ProductStateManageService;
use Illuminate\Console\Command;

class ProductStatusUpdateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product_status_update:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update products\' status according to deadline time';

    /**
     * Execute the console command.
     */
    public function handle(ProductStateManageService $service)
    {
        echo "Running " . $this->signature . "\n";
        $service->check();
    }
}
