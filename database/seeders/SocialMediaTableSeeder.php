<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMediaLink;


class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialmedia = [
            [
                'name' => 'Facebook',
                'link' => 'https://facebook.com/',
                'images'=> '["http://localhost/Agile-backend/public/socialmediaicons/images/facebook.jpg"]'
            ],
            [
                'name' => 'Instagram',
                'link' => 'https://instagram.com/',
                'images'=> '["http://localhost/Agile-backend/public/socialmediaicons/images/instagram.png"]'

            ],
            [
                'name' => 'Twitter',
                'link' => 'https://twitter.com/',
                'images'=> '["http://localhost/Agile-backend/public/socialmediaicons/images/twitter.png"]'

            ],
            [
                'name' => 'TikTok',
                'link' => 'https://www.tiktok.com/',
                'images'=> '["http://localhost/Agile-backend/public/socialmediaicons/images/tiktok.jpg"]'

            ],
            [
                'name' => 'YouTube',
                'link' => 'https://www.youtube.com/',
                'images'=> '["http://localhost/Agile-backend/public/socialmediaicons/images/youtube.png"]'

            ],
            [
                'name' => 'Telegram',
                'link' => 'https://telegram.org/',
                'images'=> '["http://localhost/Agile-backend/public/socialmediaicons/images/telegram.png"]'

            ],
        ];

        foreach($socialmedia as $socialmedialinks) {
            SocialMediaLink::create($socialmedialinks);
        }
    }
}
