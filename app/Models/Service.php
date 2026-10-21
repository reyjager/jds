<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'features', 'image', 'sort_order', 'published'];

    protected function casts(): array
    {
        return ['features' => 'array', 'published' => 'boolean'];
    }
}
