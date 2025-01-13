<?php

declare(strict_types=1);

namespace App\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use App\Enums\ArticleStatus;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ArticleResource;

final class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Posts'),
            'published' => Tab::make('Published')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', ArticleStatus::PUBLISHED);
                }),
            'draft' => Tab::make('Draft')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status', ArticleStatus::DRAFT);
                }),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
