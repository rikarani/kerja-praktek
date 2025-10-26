<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    #[Scope]
    protected function search(Builder $query, string $keyword): Builder
    {
        return $query->whereLike('title', "%$keyword%");
    }

    #[Scope]
    protected function published(Builder $query, ?bool $published = true): Builder
    {
        return $query->where('published', $published);
    }

    #[Scope]
    protected function bulan(Builder $query, ?int $bulan): Builder
    {
        return $query->when($bulan, fn (Builder $q) => $q->whereMonth('start_date', $bulan));
    }

    #[Scope]
    protected function tahun(Builder $query, ?string $tahun): Builder
    {
        return $query->when($tahun, fn (Builder $q) => $q->whereYear('start_date', $tahun));
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime:Y-m-d',
        ];
    }
}
