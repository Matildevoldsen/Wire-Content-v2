<div
    x-data="{ open: false, basket: @entangle('cartItems') }"
    @click.away="open = false;"
    class="relative inline-block text-left"
>
    <button
        @click="open = !open"
        type="button"
        class="flex items-center p-2 focus:outline-none"
        aria-haspopup="true"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
        </svg>
        <span
            class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-xs font-bold text-white"
            x-text="(basket ?? []).reduce((sum, item) => sum + item.quantity, 0)"
        ></span>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-80 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-50"
        style="display: none;"
    >
        <div class="p-4">
            @if (count($cartItems) > 0)
                <template x-for="item in (basket ?? [])" :key="item.hash">
                    <div class="flex items-center py-3 border-b last:border-0">
                        <div class="w-16 h-16 mr-4">
                            <img
                                :src="item.photo ?? 'https://via.placeholder.com/64'"
                                alt=""
                                class="object-cover rounded"
                            />
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-bold" x-text="item.name"></h3>
                            <p class="text-xs text-gray-500" x-text="item.variant"></p>
                            <div class="mt-2 flex items-center space-x-2">
                                <button
                                    @click="$wire.decrease(item.hash)"
                                    class="w-6 h-6 flex items-center justify-center border rounded focus:outline-none"
                                >–
                                </button>
                                <span x-text="item.quantity" class="text-sm"></span>
                                <button
                                    @click="$wire.increase(item.hash)"
                                    class="w-6 h-6 flex items-center justify-center border rounded focus:outline-none"
                                >+
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="mt-4 flex flex-col space-y-2">
                    <button
                        @click="open = false; $wire.clear()"
                        type="button"
                        class="flex-1 px-2 py-1 text-base font-medium text-white bg-red-600 border-transparent border rounded-md hover:bg-red-700 focus:outline-none focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                        Clear Cart
                    </button>
                    <button
                        class="max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                        Checkout
                    </button>
                </div>
            @else
                Nothing to see here!
            @endif
        </div>
    </div>
</div>
