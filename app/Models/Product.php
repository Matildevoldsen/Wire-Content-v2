<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Str;
use App\Enums\ProductStatus;
use Laravel\Scout\Searchable;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Product extends Model implements Viewable
{
    use HasFactory;
    use HasSEO;
    use InteractsWithViews;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'content',
        'status',
        'stock',
        'variants',
        'price',
    ];

    protected $casts = [
        'status' => ProductStatus::class,
        'content' => 'array',
        'variants' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeIsPublished(Builder $builder): Builder
    {
        return $builder->where('status', ProductStatus::PUBLISHED);
    }

    public function scopeIsDiscontinued(Builder $builder): Builder
    {
        return $builder->where('status', ProductStatus::DISCONTINUED);
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: Str::limit(tiptap_converter()->asText($this->content, 100)),
        );
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'product_images', 'product_id', 'media_id')
            ->withPivot('position')
            ->orderBy('position');
    }
}
