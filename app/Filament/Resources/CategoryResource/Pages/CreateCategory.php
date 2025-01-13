<?php

declare(strict_types=1);

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CategoryResource;

final class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
