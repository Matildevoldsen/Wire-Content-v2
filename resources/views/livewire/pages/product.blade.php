<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
            <!-- Image gallery -->
            <div class="flex flex-col-reverse">
                <!-- Image selector -->
                <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
                    <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                        @foreach($product->images as $image)
                            <button id="tabs-{{ $loop->index }}-tab-1"
                                    wire:key="{{ $loop->index }}"
                                    class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-indigo-500/50 focus:ring-offset-4"
                                    aria-controls="tabs-{{ $loop->index }}-panel-1" role="tab" type="button">
                                <span class="sr-only">Angled view</span>
                                <span class="absolute inset-0 overflow-hidden rounded-md">
                                <img wire:click="setPreviewUrl({{ $image }})"
                                     src="/{{ $image->path }}" alt="{{ $product->title }}"
                                     class="size-full object-cover">
                              </span>
                                <span
                                    class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-transparent ring-offset-2"
                                    aria-hidden="true"></span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div id="tabs-1-panel-1" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                        <img src="/{{ $previewUrl  }}"
                             alt="Angled front view with bag zipped and handles upright."
                             class="aspect-square w-full object-cover sm:rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Product info -->
            <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->title }}</h1>

                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl tracking-tight text-gray-900">
                        {{ Number::currency(number_format($product->price / 100, 3)) }}
                    </p>
                </div>

                <!-- Reviews -->
                <div class="mt-3">
                    <h3 class="sr-only">Reviews</h3>
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <!-- Active: "text-indigo-500", Inactive: "text-gray-300" -->
                            <svg class="size-5 shrink-0 text-indigo-500" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <svg class="size-5 shrink-0 text-indigo-500" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <svg class="size-5 shrink-0 text-indigo-500" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <svg class="size-5 shrink-0 text-indigo-500" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <svg class="size-5 shrink-0 text-gray-300" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                      d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="sr-only">4 out of 5 stars</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>

                    <div class="space-y-6 text-base text-gray-700">
                        <p>
                            {!! tiptap_converter()->asHTML($product?->content ?? '', toc: true, maxDepth: 4) !!}
                        </p>
                    </div>
                </div>

                <form class="mt-6">
                    <div class="mt-10 flex">
                        <button type="submit"
                                class="flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                            Add to basket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
