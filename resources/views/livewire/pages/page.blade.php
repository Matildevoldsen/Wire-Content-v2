@props(['page'])
<div>
    <x-filament-fabricator::layouts.base :title="$page->title">
        <x-filament-fabricator::page-blocks :blocks="$page->blocks"/>
    </x-filament-fabricator::layouts.base>
</div>
