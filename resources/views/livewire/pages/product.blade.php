<div class="py-12 space-y-3">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded">
            <main class="mx-auto prose p-6">
                <h1>
                    {{ $product?->title }}
                </h1>

                <x-mary-carousel :slides="$this->getSlides()" class="h-96" />
                {!! tiptap_converter()->asHTML($product?->content ?? '', toc: true, maxDepth: 4) !!}

                @foreach($product->categories as $category)
                    <x-tag-component :category="$category" />
                @endforeach
            </main>
        </div>
    </div>
</div>
