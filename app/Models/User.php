<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $hidden = ['password'];

    protected $with = ['role'];

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'author_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->role->name === 'Admin';
    }

    #[Scope]
    protected function search(Builder $query, string $keyword): Builder
    {
        return $query->when($keyword, fn (Builder $q) => $q->whereLike('name', "%$keyword%"));
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
