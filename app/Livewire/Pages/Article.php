<?php

namespace App\Livewire\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Article as ArticleModel;
class Article extends Component
{
    public ArticleModel $article;

    public function mount(): void
    {
        views($this->article)->record();
    }

    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.pages.article');
    }
}
