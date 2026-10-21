<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'role', 'bio', 'photo', 'sort_order', 'published'];

    public function getPhotoUrlAttribute(): ?string
    {
        return media_url($this->photo);
    }

    protected function casts(): array
    {
        return ['published' => 'boolean'];
    }
}
