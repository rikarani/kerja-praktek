<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }
}
