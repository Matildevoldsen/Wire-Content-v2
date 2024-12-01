<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Article as ArticleModel;
use Z3d0X\FilamentFabricator\Models\Page;

class Home extends Component
{
    public $articles;
    public function mount(): void
    {
        $this->articles = ArticleModel::isPublished()->limit(8)->get();
    }

    #[Layout('layouts.app')]
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.home');
    }
}
