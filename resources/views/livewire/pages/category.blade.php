<div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                @php
                    $breadcrumbs = [
                        ['link' => route('home'), 'icon' => 's-home'],
                        ['label' => Str::title($category->title)],
                    ];
                @endphp
                <x-mary-breadcrumbs separator="o-slash" :items="$breadcrumbs" />
            </div>
            <article class="prose dark:prose-dark px-6 pt-6 pb-8">
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    {{ $category->title }}
                </h1>

                <div class="mb-6">
                    <img
                        class="w-full h-auto rounded shadow-sm"
                        src="{{ isset($category->image)
                            ? asset($category->image->path)
                            : 'https://placehold.co/800x400?text=No+Image+Available' }}"
                        alt="{{ $category->image->alt_text ?? 'No image available' }}"
                    />
                </div>

                {!! tiptap_converter()->asHTML($category->content ?? '', toc: true, maxDepth: 4) !!}
            </article>
        </div>

        <section>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                Related Articles
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($category->articles as $article)
                    <livewire:components.article-card :article="$article" :key="$article->id" />
                @endforeach
            </div>
        </section>
    </div>
</div>
