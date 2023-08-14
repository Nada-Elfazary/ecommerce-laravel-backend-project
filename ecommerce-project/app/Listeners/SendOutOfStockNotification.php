<?php

namespace App\Listeners;

use App\Events\OutOfStock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductOutOfStock;

class SendOutOfStockNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OutOfStock $event): void
    {
        Notification::route('mail', 'nadaelfazary@gmail.com')
        ->notify(new ProductOutOfStock($event->product));
    }
}
