<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip if publishers already exist
        if (DB::table('publishers')->count() > 0) {
            return;
        }

        $publishers = [
            [
                'name' => 'Viz Media',
                'description' => 'One of the largest publishers of manga in the United States.',
                'country' => 'United States',
                'website' => 'https://www.viz.com',
            ],
            [
                'name' => 'Kodansha Comics',
                'description' => 'The English-language publishing arm of Kodansha, one of Japan\'s largest publishers.',
                'country' => 'Japan',
                'website' => 'https://kodansha.us',
            ],
            [
                'name' => 'Yen Press',
                'description' => 'A publishing company specializing in manga and graphic novels.',
                'country' => 'United States',
                'website' => 'https://yenpress.com',
            ],
            [
                'name' => 'Seven Seas Entertainment',
                'description' => 'An American publishing company that specializes in manga and light novels.',
                'country' => 'United States',
                'website' => 'https://sevenseasentertainment.com',
            ],
            [
                'name' => 'Dark Horse Comics',
                'description' => 'An American comic book and manga publisher.',
                'country' => 'United States',
                'website' => 'https://www.darkhorse.com',
            ],
            [
                'name' => 'Vertical Comics',
                'description' => 'A publisher focused on quality manga and Japanese literature.',
                'country' => 'United States',
                'website' => 'https://vertical-inc.com',
            ],
            [
                'name' => 'Square Enix Manga',
                'description' => 'The manga publishing division of Square Enix.',
                'country' => 'Japan',
                'website' => 'https://www.square-enix.com',
            ],
            [
                'name' => 'Tokyopop',
                'description' => 'A distributor, licensor, and publisher of manga and anime.',
                'country' => 'United States',
                'website' => 'https://www.tokyopop.com',
            ],
            [
                'name' => 'Shueisha',
                'description' => 'One of the largest publishing companies in Japan.',
                'country' => 'Japan',
                'website' => 'https://www.shueisha.co.jp',
            ],
            [
                'name' => 'Kadokawa',
                'description' => 'A major Japanese publishing company that produces manga and light novels.',
                'country' => 'Japan',
                'website' => 'https://www.kadokawa.co.jp',
            ],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}

