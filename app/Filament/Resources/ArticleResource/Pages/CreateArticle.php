<?php

declare(strict_types=1);

namespace App\Filament\Resources\ArticleResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ArticleResource;

final class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
