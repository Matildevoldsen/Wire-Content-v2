<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use App\Models\Category as CategoryModel;

final class Category extends Component
{
    public CategoryModel $category;

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.category');
    }
}
