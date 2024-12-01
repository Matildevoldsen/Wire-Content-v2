<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Z3d0X\FilamentFabricator\Models\Page as PageModel;

class Page extends Component
{
    public PageModel $page;

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.page');
    }
}
