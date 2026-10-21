<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $settings = [
            'about.hero_title' => 'About Us',
            'about.hero_image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80',
            'about.who_title' => 'Who We Are',
            'about.who_image' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=80',
            'about.who_body' => 'We are a team of creative professionals dedicated to delivering innovative digital solutions. With years of experience in web development, design, and marketing, we help businesses achieve their goals through technology.'."\n\n".'Our approach combines creativity with technical expertise to build solutions that not only look great but also perform exceptionally well.',
            'about.mission_title' => 'Our Mission',
            'about.mission_body' => 'To empower businesses with cutting-edge digital solutions that drive growth, enhance user experiences, and create lasting impact in the digital landscape.',
            'about.vision_title' => 'Our Vision',
            'about.vision_body' => 'To be a globally recognized digital agency known for innovation, quality, and delivering transformative results for our clients across all industries.',
            'about.stats' => json_encode([
                ['value' => '150+', 'label' => 'Projects Completed'],
                ['value' => '50+', 'label' => 'Happy Clients'],
                ['value' => '10+', 'label' => 'Years Experience'],
                ['value' => '20+', 'label' => 'Team Members'],
            ]),
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        foreach ([
            ['name' => 'Rey Jaguines', 'role' => 'CEO & Founder', 'sort_order' => 1],
            ['name' => 'John Mark Solomon Jaguines', 'role' => 'Lead Designer', 'sort_order' => 2],
            ['name' => 'Mike J', 'role' => 'Senior Developer', 'sort_order' => 3],
            ['name' => 'Sarah Ws', 'role' => 'Marketing Head', 'sort_order' => 4],
        ] as $member) {
            TeamMember::updateOrCreate(['name' => $member['name']], $member + ['published' => true]);
        }
    }
}
