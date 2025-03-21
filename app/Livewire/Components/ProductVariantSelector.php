<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use LukePOLO\LaraCart\CartItem;
use LukePOLO\LaraCart\LaraCart;
use Mary\Traits\Toast;

final class ProductVariantSelector extends Component
{
    use Toast;

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

    public function getSelectedOptions(): Collection
    {
        return  collect($this->selectedOptions);
    }

    private function findVariantById(string $optionId, array $variants = null): ?array
    {
        if (is_null($variants)) {
            $variants = $this->product->variants;
        }

        foreach ($variants as $key => $variant) {
            if ($key === $optionId) {
                return $variant;
            }

            if (isset($variant['children']) && is_array($variant['children'])) {
                $found = $this->findVariantById($optionId, $variant['children']);
                if ($found !== null) {
                    return $found;
                }
            }
        }

        return null;
    }

    /**
     * (Optional) This method would be used to add the product with the selected
     * configuration to the basket.
     */
    public function addToBasket(): void
    {
        if (!$this->selectedColor) {
            $this->error('Please select a color.');
        }

        // Default quantity is set to 1. You can adjust this as needed.
        $quantity = 1;
        $colorVariants = $this->getColorVariants();
        $colorVariant = $colorVariants[$this->selectedColor] ?? null;
        $selectedColorLabel = $colorVariant['label'] ?? 'Unknown Color';

        // Build descriptive options for nested selections.
        $descriptiveOptions = [];
        foreach ($this->selectedOptions as $parentKey => $optionId) {
            $variant = $this->findVariantById($optionId);
            if ($variant) {
                // Combines the variant type and label (e.g., "Size: Small").
                $descriptiveOptions[$parentKey] = $variant['type'] . ': ' . $variant['label'];
            }
        }

        $options = [
            'selected_color'   => $selectedColorLabel,
            'selected_options' => $descriptiveOptions,
        ];

        // Create a new CartItem instance.
        $cartItem = new CartItem(
            $this->product->id,
            $this->product->title,
            $this->product->price,
            $quantity,
            $options
        );

        $cart = app(LaraCart::class);

        $cart->addItem($cartItem);

        $this->success('Product added to basket.');
    }

    public function render(): View
    {
        return view('livewire.components.product-variant-selector', [
            'colorVariants' => $this->getColorVariants(),
        ]);
    }
}
