<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductResource;

final class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
