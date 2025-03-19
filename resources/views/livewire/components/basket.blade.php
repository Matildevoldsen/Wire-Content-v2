<div x-data="basketDropdown()" class="relative inline-block text-left">
    <button
        @click="toggleDropdown"
        type="button"
        aria-expanded="true"
        aria-haspopup="true"
        class="flex items-center p-2 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
        </svg>
        <span
            class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-xs font-bold text-white"
            x-text="basket.reduce((total, item) => total + item.quantity, 0)">

        </span>
    </button>

    <div
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-80 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
        style="display: none;"
    >
        <div class="p-4">
            <template x-for="(item, index) in basket" :key="index">
                <div class="flex items-center py-3 border-b last:border-0">
                    <!-- Variant Photo -->
                    <div class="w-16 h-16 mr-4">
                        <img :src="item.photo" :alt="item.variant" class="object-cover rounded" />
                    </div>
                    <div class="flex-1">
                        <!-- Item title and variant -->
                        <h3 class="text-sm font-bold" x-text="item.item"></h3>
                        <p class="text-xs text-gray-500" x-text="item.variant"></p>
                        <!-- Quantity Controls -->
                        <div class="mt-2 flex items-center space-x-2">
                            <button
                                @click="decreaseQuantity(index)"
                                class="w-6 h-6 flex items-center justify-center border rounded focus:outline-none"
                            >-</button>
                            <span x-text="item.quantity" class="text-sm"></span>
                            <button
                                @click="increaseQuantity(index)"
                                class="w-6 h-6 flex items-center justify-center border rounded focus:outline-none"
                            >+</button>
                        </div>
                    </div>
                </div>
            </template>

            <div class="mt-4">
                <button class="max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                    Checkout
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function basketDropdown() {
        return {
            open: false,
            basket: [
                // Dummy data. Replace with dynamic values as needed.
                {
                    item: "T-Shirt",
                    variant: "Red / L",
                    photo: "https://via.placeholder.com/64",
                    quantity: 1,
                },
                {
                    item: "Sneakers",
                    variant: "Black",
                    photo: "https://via.placeholder.com/64",
                    quantity: 2,
                },
            ],
            toggleDropdown() {
                this.open = !this.open;
            },
            increaseQuantiy(index) {
                this.basket[index].quantity++;
            },
            decreaseQuantiy(index) {
                if (this.basket[index].quantity > 1) {
                    this.basket[index].quantity--;
                }
            },
            checkout() {
                alert("Proceed to checkout!");
            },
        }
    }
</script>
