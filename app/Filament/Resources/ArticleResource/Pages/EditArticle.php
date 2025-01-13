<?php

declare(strict_types=1);

namespace App\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ArticleResource;

final class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        Notification::make()
            ->title('Changes saved!')
            ->success()
            ->body('Your changes have been saved!')
            ->send()
            ->sendToDatabase(auth()->user());

        parent::save($shouldRedirect, $shouldSendSavedNotification);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
