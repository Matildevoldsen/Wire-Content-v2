<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Str;

enum OrderStatus: string
{
    case PENDING = 'Pending';
    case OUT_FOR_DELIVERY = 'Out for delivery';
    case CANCELED = 'Canceled';
    case DELIVERED = 'Delivered';
    case DISPATCHED = 'Dispatched';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => Str::of(Str::title($case->name))->replace('_', ' ')])
            ->all();
    }
}
