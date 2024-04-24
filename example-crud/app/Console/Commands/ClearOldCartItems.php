<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CartItem;
use Carbon\Carbon;

class ClearOldCartItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:clear';
    protected $description = 'Clear cart in 24 hrs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expirationTime = Carbon::now()->subHours(24);
        $expiredItemsCount = CartItem::where('created_at', '<', $expirationTime)->delete();
        $this->info('Expired cart items cleared: ' . $expiredItemsCount);
    }
}
