<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\View\View;
use Datlechin\FilamentMenuBuilder\Models\Menu;

final class Navbar extends Component
{
    public bool $responsiveMenu = false;

    public function toggleDrawer(): void
    {
        $this->responsiveMenu = ! $this->responsiveMenu;
    }

    public function render(): View
    {
        return view('livewire.components.navbar', [
            'menu' => Menu::location('header'),
            'dropdown' => Menu::location('dropdown'),
        ]);
    }
}
