<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Models\Article as ArticleModel;
use App\Models\Product as ProductModel;

final class Home extends Component
{
    public $articles;

    public $products;

    public function mount(): void
    {
        $this->articles = ArticleModel::isPublished()->limit(8)->get();
        $this->products = ProductModel::isPublished()->limit(8)->get();
    }

    #[Layout('layouts.app')]
    public function render(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.pages.home');
    }
}
