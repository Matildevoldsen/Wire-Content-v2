<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use App\Enums\OrderStatus;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\OrderResource\Pages;
use MarcoGermani87\FilamentCaptcha\Forms\Components\CaptchaField;

final class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email'),
                TextInput::make('total'),
                TextInput::make('taxes'),
                TextInput::make('discount'),
                Select::make('status')
                    ->searchable()
                    ->options(OrderStatus::options()),
                CaptchaField::make('captcha')
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
                Tables\Actions\ViewAction::make(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return  $infolist->schema([
            Tabs::make()->schema([
                Tabs\Tab::make('Order Details')->schema([
                    Section::make()->schema([
                        TextEntry::make('order_id'),
                        TextEntry::make('total'),
                        TextEntry::make('email'),
                        TextEntry::make('taxes'),
                        TextEntry::make('discount'),
                        TextEntry::make('status'),
                    ]),
                ]),
                Tabs\Tab::make('Address')->schema([
                    Section::make()->schema([
                        TextEntry::make('address.address_line_1'),
                        TextEntry::make('address.address_line_2'),
                        TextEntry::make('address.city'),
                        TextEntry::make('address.state'),
                        TextEntry::make('address.zip'),
                        TextEntry::make('address.name'),
                    ]),
                ])
            ])
        ])->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
