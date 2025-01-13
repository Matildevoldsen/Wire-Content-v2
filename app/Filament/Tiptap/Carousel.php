<?php

declare(strict_types=1);

namespace App\Filament\Tiptap;

use FilamentTiptapEditor\TiptapBlock;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;

final class Carousel extends TiptapBlock
{
    public string $preview = 'blocks.previews.carousel';

    public string $rendered = 'blocks.rendered.carousel';

    public function getFormSchema(): array
    {
        return [
            Repeater::make('images')
                ->schema([
                    FileUpload::make('image')->required(),
                ]),
        ];
    }
}
