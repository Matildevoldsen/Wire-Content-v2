<div class="py-12 space-y-3">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded">
            <article class="mx-auto prose p-6">
                <h1>
                    {{ $category?->title }}
                </h1>

                <img class="rounded-sm" src="/{{ $category->image->path }}" alt="{{  $category->image->alt_text }}"/>

                {!! tiptap_converter()->asHTML($category?->content ?? '', toc: true, maxDepth: 4) !!}
            </article>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($category->articles as $article)
                <livewire:components.article-card :article="$article" :key="$article->id" />
            @endforeach
        </div>
    </div>
</div>
