<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Collection;

final class ProductVariantSelector extends Component
{
    public Product $product;

    /**
     * The ID of the selected top-level (Color) variant.
     */
    public ?string $selectedColor = null;

    /**
     * The nested selections.
     * Selections are stored by parent key, for example:
     * [
     *     // For children of the selected Color (keyed by color variant id):
     *     'e50cc378-3057-446c-abc5-507f9d4e07a9' => '5f6af136-55d9-44ba-ab9e-3c80a89651f6',
     *     // For nested choices under the above option (keyed by the previously selected option id):
     *     '5f6af136-55d9-44ba-ab9e-3c80a89651f6' => 'another-variant-id',
     * ]
     */
    public array $selectedOptions = [];

    public function mount(): void
    {
        $this->selectedColor = null;
        $this->selectedOptions = [];
    }

    public function selectColor(string $color): void
    {
        $this->selectedColor = $color;
        // Reset any nested selections when the color changes.
        $this->selectedOptions = [];
    }

    /**
     * Returns all top-level variants that are of type "Color".
     */
    public function getColorVariants(): Collection
    {
        return collect($this->product->variants)
            ->filter(fn ($variant) => $variant['type'] === 'Color');
    }

    /**
     * (Optional) This method would be used to add the product with the selected
     * configuration to the basket.
     */
    public function addToBasket(): void
    {
        // Validate that a color has been selected, and—for example—a valid Range option,
        // if applicable. Use $this->selectedColor and $this->selectedOptions.
        // Then add the product (and variant choices) to the basket.
        // You may dispatch an event or redirect as needed.
        //
        // For this example, we simply emit an event.
//        $this->dispatch('productAddedToBasket', [
//            'productId' => $this->product->id,
//            'color' => $this->selectedColor,
//            'variants' => $this->selectedOptions,
//        ]);
    }

    public function render(): View
    {
        return view('livewire.components.product-variant-selector', [
            'colorVariants' => $this->getColorVariants(),
        ]);
    }
}
