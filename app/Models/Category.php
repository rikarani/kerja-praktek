<?php

namespace App\Models;

use App\Policies\CategoryPolicy;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;

#[UsePolicy(CategoryPolicy::class)]
class Category extends Model
{
    use HasUuids, Sluggable;

    protected $guarded = ['id'];

    protected $with = ['activities'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
