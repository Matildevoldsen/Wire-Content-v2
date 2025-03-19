<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\View\View;

final class Basket extends Component
{
    public function increase() {}

    public function decrease() {}

    public function render(): View
    {
        return view('livewire.components.basket');
    }
}
