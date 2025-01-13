<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;

final class Product extends Component
{
    public ProductModel $product;
    public string $previewUrl;

    public function mount(): void
    {
        views($this->product)->record();
        $this->previewUrl = (string) $this->product->images?->first()->path;
    }

    public function getSlides(): array
    {
        return $this->product->images->map(function ($image) {
            return [
                'image' => Storage::url($image->path),
            ];
        })->toArray();
    }

    public function setPreviewUrl($image): void
    {
        $this->previewUrl = (string) $image['path'];
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.product');
    }
}
