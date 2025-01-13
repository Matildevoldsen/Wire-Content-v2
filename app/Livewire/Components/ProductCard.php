<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;
use Illuminate\View\View;

final class ProductCard extends Component
{
    public Product $product;

    public function render(): View
    {
        return view('livewire.components.product-card');
    }
}
