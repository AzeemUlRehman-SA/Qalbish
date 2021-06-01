<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'Helpline Support',
            'value' => '0321 4155705',
        ]);

        Setting::create([
            'name' => 'Email Support',
            'value' => 'info@qalbish.com',
        ]);

        Setting::create([
            'name' => 'Find Us At',
            'value' => '3 A Eden city commercial area near phase. 8 Lahore, Pakistan',
        ]);

        Setting::create([
            'name' => 'Suggestion',
            'value' => 'info@qalbish.com',
        ]);
        Setting::create([
            'name' => 'Bug Report',
            'value' => 'info@qalbish.com',
        ]);

        Setting::create([
            'name' => 'Complaint',
            'value' => 'info@qalbish.com',
        ]);

        Setting::create([
            'name' => 'Feature Request',
            'value' => 'info@qalbish.com',
        ]);

        Setting::create([
            'name' => 'Other',
            'value' => 'info@qalbish.com',
        ]);

        Setting::create([
            'name' => 'Whatsapp',
            'value' => 'https://web.whatsapp.com',
        ]);

        Setting::create([
            'name' => 'Instagram',
            'value' => 'http://instagram.com',
        ]);

        Setting::create([
            'name' => 'Facebook',
            'value' => 'http://facebook.com',
        ]);


    }
}
