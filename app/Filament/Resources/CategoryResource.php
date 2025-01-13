<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Forms\Components\Slug;
use Filament\Resources\Resource;
use RalphJSmit\Filament\SEO\SEO;
use FilamentTiptapEditor\TiptapEditor;
use FilamentTiptapEditor\Enums\TiptapOutput;
use App\Filament\Resources\CategoryResource\Pages;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;

final class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->schema([
                    Forms\Components\Tabs\Tab::make('Content')->schema([
                        Forms\Components\TextInput::make('title'),
                        Slug::make('slug')->required(),
                        TiptapEditor::make('content')
                            ->output(TiptapOutput::Json)
                            ->required(),
                        CuratorPicker::make('media_id'),
                        Forms\Components\ColorPicker::make('text_color'),
                        Forms\Components\ColorPicker::make('background_color'),
                        Forms\Components\Toggle::make('is_tag'),
                        Forms\Components\Select::make('parent_id')
                            ->searchable()
                            ->relationship('parent', 'title'),
                        Forms\Components\Hidden::make('user_id')
                            ->dehydrateStateUsing(fn ($state) => auth()->id()),
                    ]),
                    Forms\Components\Tabs\Tab::make('SEO')->schema([
                        SEO::make(),
                    ]),
                ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('media_id')
                    ->label('Image')
                    ->size(40),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ColorColumn::make('text_color')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ColorColumn::make('background_color')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
