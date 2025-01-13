<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\Article;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

final class Spotlight
{
    public function search(Request $request)
    {
        return collect()
            ->merge($this->searchProducts($request->search))
            ->merge($this->searchArticles($request->search));
    }

    public function searchArticles(string $search = '')
    {
        return Article::search($search)
            ->take(5)
            ->get()
            ->map(function (Article $article) {
                return [
                    'avatar' => $article->image->path,
                    'name' => $article->title,
                    'description' => Str::limit(tiptap_converter()->asText($article?->content, 50)),
                    'link' => "/articles/{$article->slug}",
                ];
            });
    }

    public function searchProducts(string $search = '')
    {
        return Product::search($search)
            ->take(5)
            ->get()
            ->map(function (Product $product) {
                return [
                    'avatar' => $product->images->first()?->path,
                    'name' => $product->title,
                    'description' => Str::limit(tiptap_converter()->asText($product?->content, 50)),
                    'link' => "/products/{$product->slug}",
                ];
            });
    }

    public function searchCategories(string $search = '')
    {
        return Category::search($search)
            ->take(5)
            ->get()
            ->map(function (Category $category) {
                return [
                    'icon' => Blade::render("<x-mary-icon name='o-bolt' />"),
                    'name' => $category->title,
                    'description' => Str::limit(tiptap_converter()->asText($category?->content, 50)),
                    'link' => "/categories/{$category->slug}",
                ];
            });
    }
}
