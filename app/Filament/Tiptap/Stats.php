<?php

declare(strict_types=1);

namespace App\Filament\Tiptap;

use FilamentTiptapEditor\TiptapBlock;
use Filament\Forms\Components\TextInput;

final class Stats extends TiptapBlock
{
    public string $preview = 'blocks.previews.stats';

    public string $rendered = 'blocks.rendered.stats';

    public function getFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),
            TextInput::make('value')->required(),
            TextInput::make('description')->required(),
        ];
    }
}
