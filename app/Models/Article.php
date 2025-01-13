<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Str;
use App\Enums\ArticleStatus;
use Laravel\Scout\Searchable;
use Awcodes\Curator\Models\Media;
use WireComments\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Article extends Model implements Viewable
{
    use Commentable;
    use HasFactory;
    use HasSEO;
    use InteractsWithViews;
    use Searchable;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'status' => ArticleStatus::class,
        'content' => 'array',
    ];

    public function scopeIsPublished(Builder $builder): Builder
    {
        return $builder->where('status', ArticleStatus::PUBLISHED);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: Str::limit(tiptap_converter()->asText($this->content, 100)),
            image: $this->image?->path,
        );
    }
}
