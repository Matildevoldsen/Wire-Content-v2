<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Category extends Model
{
    use HasFactory;
    use HasSEO;
    use Searchable;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'media_id',
        'text_color',
        'background_color',
        'is_tag',
        'parent_id',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: tiptap_converter()->asText(Str::limit($this->content, 160)),
            image: $this->image?->path,
        );
    }
}
