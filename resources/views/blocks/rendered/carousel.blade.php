<div>
    <x-mary-carousel :slides="array_map(function ($item) {
            return [
                'image' => '/' . $item['image']
            ];
        }, $images)"/>
</div>
