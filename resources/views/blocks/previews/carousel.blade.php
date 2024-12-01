<div>
    @foreach($images as $image)
        <img src="/{{ $image['image'] }}" class="w-32" alt="">
    @endforeach
</div>
