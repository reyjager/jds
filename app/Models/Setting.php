<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function value(string $key, mixed $default = null): mixed
    {
        $value = static::query()->where('key', $key)->value('value');

        return $value === null || $value === '' ? $default : $value;
    }
}