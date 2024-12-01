<?php

namespace App\Livewire\Components;

use App\Models\Article as ArticleModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use \Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class ArticleGrid extends Component
{
    use WithPagination;

    public Collection $articles;
    public int $limit;
    public $category;
    public $sort_by;
    public bool $show_load_more = false;

    public function mount(): void
    {
        $this->loadMore();
    }

    public function loadMore(): void
    {
        $offset = 0;
        if (isset($this->articles)) {
            $offset = $this->articles->count();
        }

        $newArticles = $this->sort_by === 'popular'
            ? $this->getArticlesByViews($offset)
            : $this->getArticlesBySortOrder($offset);

        if (isset($this->articles)) {
            $this->articles = $this->articles->merge($newArticles);
        } else {
            $this->articles = $newArticles;
        }
        $this->show_load_more = $newArticles->count() >= $this->limit;
    }

    private function getBaseQuery(): Builder
    {
        return ArticleModel::with('categories')
            ->whereHas('categories', function ($query) {
                $query->whereIn('categories.id',  (array) $this->category);
            });
    }

    private function getArticlesByViews(int $offset = 0): Collection
    {
        $cacheKey = 'articles_by_views_' . implode('_', (array) $this->category) . '_offset_' . $offset;
        return cache()->remember($cacheKey, now()->addMinutes(10), function () use ($offset) {
            return $this->getBaseQuery()
                ->orderByViews() // Custom sorting by views
                ->skip($offset) // Skip already loaded articles
                ->limit($this->limit)
                ->get();
        });
    }

    private function getArticlesBySortOrder(int $offset = 0): Collection
    {
        $cacheKey = 'articles_by_sort_' . implode('_', (array) $this->category) . '_' . $this->sort_by . '_offset_' . $offset;

        return cache()->remember($cacheKey, now()->addMinutes(10), function () use ($offset) {
            $validColumns = ['created_at', 'updated_at'];
            $sortBy = in_array($this->sort_by, $validColumns) ? $this->sort_by : 'created_at';

            return $this->getBaseQuery()
                ->orderBy($sortBy, 'desc') // Custom sorting by a valid column
                ->skip($offset) // Skip already loaded articles
                ->limit($this->limit)
                ->get();
        });
    }

    public function render(): View
    {
        return view('livewire.components.article-grid');
    }
}
