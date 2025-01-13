<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Z3d0X\FilamentFabricator\Models\Page as PageModel;

final class Page extends Component
{
    public PageModel $page;

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.page');
    }
}
