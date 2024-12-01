<?php

namespace App\Filament\Fabricator\PageBlocks;

use App\Models\Article;
use App\Models\Category;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class ArticleBlock extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('article')
            ->schema([
                Select::make('limit')
                    ->label('Article Limit')
                    ->required()
                    ->options([
                        '3' => '3',
                        '6' => '6',
                        '9' => '9',
                        '12' => '12',
                    ])
                    ->searchable(),
                Select::make('category')
                    ->options(Category::pluck('title', 'id')->toArray())
                    ->label('Category')
                    ->multiple()
                    ->required()
                    ->searchable(),
                Select::make('sort_by')->required()
                    ->options([
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At',
                    'popular' => 'Most Popular'
                ])->searchable(),
                Select::make('show_load_more')->label('Show Load More Button')
                    ->options([
                        'true' => 'Yes',
                        'false' => 'No'
                    ]),
                TextInput::make('heading')->required()->label('Heading'),
                TiptapEditor::make('description')
                    ->label('Short Description')
                    ->output(TiptapOutput::Json)
            ]);
    }

    public static function mutateData(array $data): array
    {
        return [
            'limit' => $data['limit'],
            'category' => $data['category'],
            'sort_by' => $data['sort_by'],
            'heading' => $data['heading'],
            'show_load_more' => $data['show_load_more'],
            'description' => $data['description'],
        ];
    }
}
