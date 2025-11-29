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
        return $query->when($keyword, fn (Builder $q) => $q->whereLike('title', "%{$keyword}%"));
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

    #[Scope]
    protected function filterByCategory(Builder $query, ?string $kategori): Builder
    {
        return $query->whereRelationEquals('category', 'slug', $kategori);
    }

    #[Scope]
    protected function filterByAuthor(Builder $query, ?string $author): Builder
    {
        return $query->whereRelationEquals('author', 'name', $author);
    }

    #[Scope]
    protected function whereRelationEquals(Builder $query, string $relation, string $column, mixed $value): Builder
    {
        return $query->when($value, fn ($q) => $q->whereHas($relation, fn ($r) => $r->where($column, $value)));
    }

    #[Scope]
    protected function filters(Builder $query, array $filters): Builder
    {
        return $query->search($filters['search'] ?? null)
            ->month($filters['month'] ?? null)
            ->year($filters['year'] ?? null)
            ->filterByCategory($filters['category'] ?? null)
            ->filterByAuthor($filters['author'] ?? null)
            ->when($filters['author_only'] ?? null, fn ($q, $authorId) => $q->where('author_id', $authorId));
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime:Y-m-d',
        ];
    }
}
