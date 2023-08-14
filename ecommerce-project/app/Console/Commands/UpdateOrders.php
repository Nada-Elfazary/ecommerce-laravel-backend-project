<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessOrders;
use App\Models\Order;

class UpdateOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update order status from placed to delivered ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('status', 'placed')->get();
        ProcessOrders::dispatch($orders);
        return 'Orders Updated Successfully';
    }
}
