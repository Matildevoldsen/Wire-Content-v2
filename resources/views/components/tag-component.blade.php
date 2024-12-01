<a href="{{ route('category.show', $category) }}" wire:navigate>
    <x-mary-badge value="{{ $category->title }}" class="badge badge-primary" />
</a>
