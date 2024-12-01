<?php

namespace App\Filament\Tiptap;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapBlock;

class Stats extends TiptapBlock
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
