<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioProject extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'category', 'description', 'image', 'project_url', 'sort_order', 'published'];

    protected function casts(): array
    {
        return ['published' => 'boolean'];
    }
}
