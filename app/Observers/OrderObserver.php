<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Str;

final class OrderObserver
{
    public function creating(Order $order): void
    {
        $order->order_id = Str::uuid();
    }
}
