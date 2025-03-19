<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Str;

enum ArticleStatus: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';

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
