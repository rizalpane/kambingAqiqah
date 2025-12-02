<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteFailedPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:delete-failed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete failed payment orders that are older than 72 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $seventyTwoHoursAgo = Carbon::now()->subHours(72);

        $deletedCount = Order::where('status', 'failed')
            ->where('created_at', '<', $seventyTwoHoursAgo)
            ->delete();

        if ($deletedCount > 0) {
            $this->info("Deleted {$deletedCount} failed payment orders.");
        } else {
            $this->info('No failed payment orders to delete.');
        }
    }
}
