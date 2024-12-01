<?php

namespace App\Livewire\Components;

use App\Models\Article;
use Illuminate\View\View;
use Livewire\Component;

class ArticleCard extends Component
{
    public Article $article;

    public function render(): View
    {
        return view('livewire.components.article-card');
    }
}
