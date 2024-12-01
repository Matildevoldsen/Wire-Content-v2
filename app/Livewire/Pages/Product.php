<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public ProductModel $product;

    public function mount(): void
    {
        views($this->product)->record();
    }

    public function getSlides(): array
    {
        return $this->product->images->map(function ($image) {
            return [
                'image' => Storage::url($image->path),
            ];
        })->toArray();
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.product');
    }
}
