<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function show(): View
    {
        $stats = json_decode((string) setting('about.stats', '[]'), true);

        return view('about', [
            'settings' => $this->settings(),
            'stats' => is_array($stats) ? $stats : [],
            'teamMembers' => TeamMember::query()
                ->where('published', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function edit(): View
    {
        $stats = json_decode((string) setting('about.stats', '[]'), true);

        return view('admin.about.edit', [
            'settings' => $this->settings(),
            'stats' => is_array($stats) ? $stats : [],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hero_title' => ['required', 'string', 'max:255'],
            'who_title' => ['required', 'string', 'max:255'],
            'who_body' => ['required', 'string'],
            'mission_title' => ['required', 'string', 'max:255'],
            'mission_body' => ['required', 'string'],
            'vision_title' => ['required', 'string', 'max:255'],
            'vision_body' => ['required', 'string'],
            'stat_value' => ['required', 'array', 'max:4'],
            'stat_value.*' => ['required', 'string', 'max:50'],
            'stat_label' => ['required', 'array', 'max:4'],
            'stat_label.*' => ['required', 'string', 'max:100'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'who_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        foreach (['hero_image', 'who_image'] as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $oldImage = setting('about.'.$imageKey);
                $data[$imageKey] = $request->file($imageKey)->store('about', 'public');
                $this->deleteLocalImage($oldImage);
            }
        }

        foreach (['hero_title', 'who_title', 'who_body', 'mission_title', 'mission_body', 'vision_title', 'vision_body', 'hero_image', 'who_image'] as $key) {
            if (array_key_exists($key, $data)) {
                Setting::updateOrCreate(['key' => 'about.'.$key], ['value' => $data[$key]]);
            }
        }

        $stats = [];
        foreach ($data['stat_value'] as $index => $value) {
            $stats[] = ['value' => $value, 'label' => $data['stat_label'][$index] ?? ''];
        }
        Setting::updateOrCreate(['key' => 'about.stats'], ['value' => json_encode($stats)]);

        return redirect()->route('admin.about.edit')->with('success', 'About page updated.');
    }

    private function settings(): array
    {
        return [
            'hero_title' => setting('about.hero_title', 'About Us'),
            'hero_image' => setting('about.hero_image'),
            'who_title' => setting('about.who_title', 'Who We Are'),
            'who_image' => setting('about.who_image'),
            'who_body' => setting('about.who_body', ''),
            'mission_title' => setting('about.mission_title', 'Our Mission'),
            'mission_body' => setting('about.mission_body', ''),
            'vision_title' => setting('about.vision_title', 'Our Vision'),
            'vision_body' => setting('about.vision_body', ''),
        ];
    }

    private function deleteLocalImage(?string $path): void
    {
        if ($path !== null && ! str_starts_with($path, 'http://') && ! str_starts_with($path, 'https://')) {
            Storage::disk('public')->delete($path);
        }
    }
}