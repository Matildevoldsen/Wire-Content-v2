@aware(['page'])
@props(['images', 'title', 'description'])
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">

        <h2 class="text-2xl text-center text-gray-900 font-bold md:text-4xl md:leading-tight dark:text-white">
            {{ $title }}
        </h2>

        @if (tiptap_converter()->asText($description))
            <p>
                {!! tiptap_converter()->asHTML($description ?? '', toc: true, maxDepth: 4) !!}
            </p>
        @endif
    </div>

    <div class="max-w-3xl mt-2 mx-auto">
        <x-mary-carousel :slides="array_map(function ($item) {
            return [
                'image' => '/' . $item['image']
            ];
        }, $images)"/>
    </div>
</div>
