<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email'=>'amr@gmail.com',
            'phone'=>'01014058436',
            'facebook'=>'https://www.facebook.com',
            'twitter'=>'https://www.twitter.com',
            'instagram'=>'https://www.instagram.com',
            'youtube'=>'https://www.youtube.com',
            'linkedin'=>'https://www.linkedin.com',
        ]);
    }
}
