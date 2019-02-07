<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'body', 'published_at', 'path',
    ];

    protected $dates = [
        'published_at', 'deleted_at',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($post) {
            $post->slug = str_slug($post->title);

            return true;
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setPublishedAtAttribute($value): void
    {
        if ($value instanceof DateTime) {
            $this->attributes['published_at'] = $value;
            return;
        }

        if (!$value) {
            $this->attributes['published_at'] = null;
            return;
        }

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    public function getSummaryAttribute(): string
    {
        return str_limit($this->attributes['body'], 200);
    }

    public function isPublished(): bool
    {
        return $this->attributes['published_at'] !== null
            && Carbon::parse($this->attributes['published_at'])->isPast();
    }

    public function isScheduledForPublishing(): bool
    {
        return $this->attributes['published_at'] !== null
            && Carbon::parse($this->attributes['published_at'])->isFuture();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<', Carbon::now());
    }
}
