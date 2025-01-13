<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

final class TagComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Category $category) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag-component');
    }
}
