<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Category as CategoryModel;

class Category extends Component
{
    public CategoryModel $category;

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.category');
    }
}
