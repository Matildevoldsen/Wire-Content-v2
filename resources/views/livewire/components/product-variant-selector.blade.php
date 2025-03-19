<div class="space-y-8">
    <!-- Color Selector -->
    <div>
        <h2 class="text-sm font-medium text-gray-900">Color</h2>
        <div class="mt-4 flex items-center space-x-3">
            @foreach($colorVariants as $id => $variant)
                <button
                    type="button"
                    wire:click="selectColor('{{ $id }}')"
                    class="relative h-8 w-8 rounded-full border border-gray-300 p-0.5
                        @if($selectedColor === $id) ring-2 ring-indigo-500 @endif"
                >
                    <span
                        class="block h-full w-full rounded-full"
                        style="background-color: {{ $variant['color'] }};"
                    ></span>
                    <span class="sr-only">{{ $variant['label'] }}</span>
                </button>
            @endforeach
        </div>
        @if($selectedColor)
            <p class="mt-2 text-sm text-gray-500">
                Selected: {{ $colorVariants[$selectedColor]['label'] }}
            </p>
        @endif
    </div>

    <!-- Nested Variant Selector (e.g. Range options) -->
    @if($selectedColor && isset($product->variants[$selectedColor]['children']))
        <div>
            @php
                // Optionally, infer a group label from the first child’s type.
                $childGroup = $product->variants[$selectedColor]['children'];
                $groupType = count($childGroup)
                    ? (reset($childGroup)['type'] ?? 'Options')
                    : 'Options';
            @endphp
            <h3 class="text-sm font-medium text-gray-900">Select {{ $groupType }}</h3>

            <!-- Include the recursive partial.
                 The first level uses the selected color’s children.
                 The “parent key” for this level is the selected color ID. -->
            @include('livewire.components.variant-tree', [
                'variants'  => $product->variants[$selectedColor]['children'],
                'parentKey' => $selectedColor
            ])
        </div>
    @endif

    <!-- (Optional) Add to Basket button -->
    <form class="mt-6">
        <div class="mt-10 flex">
            <button type="submit"
                    {{ $selectedColor ? '' : 'disabled' }}
                    class="flex {{ !$selectedColor ? 'cursor-not-allowed' : '' }} max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                Add to basket
            </button>
        </div>
    </form>
</div>
