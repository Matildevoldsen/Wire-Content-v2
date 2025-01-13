<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use App\Enums\OrderStatus;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\OrderResource\Pages;

final class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id'),
                Tables\Columns\TextColumn::make('total'),
                Tables\Columns\TextColumn::make('taxes'),
                Tables\Columns\TextColumn::make('discount'),
                Tables\Columns\SelectColumn::make('status')
                    ->searchable()
                    ->options(OrderStatus::options()),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
