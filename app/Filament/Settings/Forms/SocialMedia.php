<?php

namespace App\Filament\Settings\Forms;

use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;

class SocialMedia
{
    /**
     * @return Tab
     */
    public static function getTab(): Tab
    {
        return Tab::make('social_media')
                    ->label(__('Social Media'))
                    ->icon('heroicon-o-computer-desktop')
                    ->schema(self::getFields())
                    ->columns()
                    ->statePath('social_media')
                    ->visible(true);
    }

    public static function getFields(): array
    {
        return [
            TextInput::make('facebook_url'),
        ];
    }

    public static function getSortOrder(): int
    {
       return 1;
    }
}
