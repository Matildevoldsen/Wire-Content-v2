<div class="py-12 space-y-3">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded">
            <article class="mx-auto prose p-6">
                <h1>
                    {{ $article?->title }}
                </h1>

                <img class="rounded-sm" src="/{{ $article->image->path }}" alt="{{  $article->image->alt_text }}"/>

                {!! tiptap_converter()->asHTML($article?->content ?? '', toc: true, maxDepth: 4) !!}

                @foreach($article->categories as $category)
                    <x-tag-component :category="$category" />
                @endforeach
            </article>
        </div>
    </div>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="p-10 bg-white dark:bg-gray-800 shadow rounded overflow-hidden">
            <livewire:comments :model="$article" :emojis="['👍', '👎', '❤️', '😂', '😯', '😢', '😡']" />
        </div>
    </div>
</div>
