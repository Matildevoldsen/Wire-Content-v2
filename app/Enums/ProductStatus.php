<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum ProductStatus: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
    case ARCHIVED = 'Archived';
    case DISCONTINUED = 'Discontinued';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => Str::title($case->name)])
            ->all();
    }
}
