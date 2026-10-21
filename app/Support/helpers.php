<?php

use App\Models\Setting;
use Illuminate\Support\Str;

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::value($key, $default);
    }
}

if (! function_exists('media_url')) {
    function media_url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        return Str::startsWith($path, ['http://', 'https://'])
            ? $path
            : asset('storage/'.ltrim($path, '/'));
    }
}