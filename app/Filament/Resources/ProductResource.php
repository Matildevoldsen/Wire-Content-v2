<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\ProductStatus;
use App\Forms\Components\Slug;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use RalphJSmit\Filament\SEO\SEO;
use FilamentTiptapEditor\TiptapEditor;
use FilamentTiptapEditor\Enums\TiptapOutput;
use App\Filament\Resources\ProductResource\Pages;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use CodeWithDennis\FilamentPriceFilter\Filament\Tables\Filters\PriceFilter;

final class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

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
                        Forms\Components\Select::make('category')
                            ->multiple()
                            ->preload()
                            ->relationship('categories', 'title')
                            ->searchable(),
                        Forms\Components\Hidden::make('user_id')->dehydrateStateUsing(fn ($state) => auth()->id()),
                        Forms\Components\Select::make('status')
                            ->options(ProductStatus::options()),
                        CuratorPicker::make('images')
                            ->multiple()
                            ->relationship('images', 'id')
                            ->orderColumn('position')
                            ->required(),
                        Forms\Components\TextInput::make('stock')->required()->numeric(),
                        Forms\Components\TextInput::make('price')->required()->numeric(),
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
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('price')
                    ->numeric(),
                Tables\Columns\TextColumn::make('stock')->numeric(),
            ])
            ->filters([
                PriceFilter::make('price'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
