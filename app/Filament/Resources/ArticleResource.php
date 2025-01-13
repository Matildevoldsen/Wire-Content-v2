<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\ArticleStatus;
use App\Forms\Components\Slug;
use Filament\Resources\Resource;
use RalphJSmit\Filament\SEO\SEO;
use FilamentTiptapEditor\TiptapEditor;
use FilamentTiptapEditor\Enums\TiptapOutput;
use App\Filament\Resources\ArticleResource\Pages;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;

final class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

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
                        Forms\Components\Select::make('category')
                            ->multiple()
                            ->preload()
                            ->relationship('categories', 'title')
                            ->searchable(),
                        Forms\Components\Hidden::make('user_id')->dehydrateStateUsing(fn ($state) => auth()->id()),
                        Forms\Components\Select::make('status')
                            ->options(ArticleStatus::options()),
                    ]),
                    Forms\Components\Tabs\Tab::make('SEO')->schema([
                        SEO::make(),
                    ]),
                    Forms\Components\Tabs\Tab::make('Media')->schema([
                        CuratorPicker::make('media_id'),
                    ]),
                ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('media_id')
                    ->label('Thumbnail')
                    ->size(40),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->searchable()->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->sortable()
                    ->options(ArticleStatus::options()),
                Tables\Columns\TextColumn::make('categories.title')
                    ->sortable()
                    ->badge()
                    ->searchable(),
            ])
            ->filters([

                Tables\Filters\SelectFilter::make('categories')
                    ->multiple()
                    ->searchable()
                    ->relationship('categories', 'title'),
                Tables\Filters\SelectFilter::make('status')->options(ArticleStatus::options()),
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
