<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use LukePOLO\LaraCart\LaraCart;
use Illuminate\View\View;

final class Basket extends Component
{
    public array $cartItems = [];

    public function boot(LaraCart $cart): void
    {
        $this->cart = $cart;
    }

    public function mount(): void
    {
        $this->refreshBasket();
    }

    #[On('refreshBasket')]
    public function refreshBasket(): void
    {
        $this->cartItems = collect($this->cart->getItems())
            ->map(fn ($item) => [
                'hash'     => $item->getHash(),
                'name'     => $item->name,
                'quantity' => $item->qty,
                'variant'  => $item->options['selected_color']
                    ?? $item->options['variant']
                        ?? '',
                'photo'    => $item->options['photo'] ?? null,
            ])
            ->values()
            ->toArray();
    }

    public function increase(string $hash): void
    {
        $this->cart->increment($hash);
        $this->refreshBasket();
    }

    public function decrease(string $hash): void
    {
        $this->cart->decrement($hash);
        $this->refreshBasket();
    }

    public function clear(): void
    {
        $this->cart->emptyCart();
        $this->dispatch('refreshBasket');
    }

    public function render(): View
    {
        return view('livewire.components.basket');
    }
}
