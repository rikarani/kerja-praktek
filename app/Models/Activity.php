<?php

namespace App\Models;

use App\Policies\ActivityPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;

#[UsePolicy(ActivityPolicy::class)]
class Activity extends Model
{
    use HasUuids, Sluggable;

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

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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
    protected function month(Builder $query, ?int $bulan): Builder
    {
        return $query->when($bulan, fn (Builder $q) => $q->whereMonth('start_date', $bulan));
    }

    #[Scope]
    protected function year(Builder $query, ?string $tahun): Builder
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
