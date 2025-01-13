<a class="group relative"
   wire:navigate
   href="{{ route('product.show', $product) }}">
    <div class="aspect-w-16 aspect-h-11">
        <img
            class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80"
            src="/{{ $product?->images?->first()->path }}"
            alt="{{  $product?->image?->alt_text }}"/>
        <h3 class="tetext-sm text-gray-700">
            {{ $product->title }}
        </h3>
        @if ($product->content)
            <p class="mt-1 text-sm text-gray-500">
                {!! Str::limit(tiptap_converter()->asText($product?->content, 100)) !!}
            </p>
        @endif
    </div>
    <h5 class="text-sm font-medium text-gray-900">
        {{ Number::currency(number_format($product->price / 100, 3)) }}
    </h5>
</a>
