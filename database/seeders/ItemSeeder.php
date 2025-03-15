<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip if items already exist
        if (DB::table('items')->count() > 0) {
            return;
        }

        $mangaTitles = [
            'One Piece Volume 1: Romance Dawn',
            'Naruto Volume 1: Uzumaki Naruto',
            'Bleach Volume 1: The Death and the Strawberry',
            'Dragon Ball Volume 1: The Monkey King',
            'Attack on Titan Volume 1',
            'My Hero Academia Volume 1: Izuku Midoriya: Origin',
            'Demon Slayer Volume 1: Cruelty',
            'Jujutsu Kaisen Volume 1',
            'Tokyo Ghoul Volume 1',
            'Death Note Volume 1: Boredom',
            'Fullmetal Alchemist Volume 1',
            'Hunter x Hunter Volume 1',
            'Sailor Moon Volume 1',
            'Fruits Basket Volume 1',
            'Nana Volume 1',
            'Ouran High School Host Club Volume 1',
            'Berserk Volume 1: The Black Swordsman',
            'Vagabond Volume 1',
            'Vinland Saga Volume 1',
            'Monster Volume 1',
            'Spy x Family Volume 1',
            'Chainsaw Man Volume 1',
            'Haikyu!! Volume 1',
            'Slam Dunk Volume 1',
            'Your Lie in April Volume 1',
            'A Silent Voice Volume 1',
            'The Promised Neverland Volume 1',
            'Made in Abyss Volume 1',
            'Re:Zero Volume 1',
            'Sword Art Online Volume 1',
        ];

        $authors = [
            'Eiichiro Oda',
            'Masashi Kishimoto',
            'Tite Kubo',
            'Akira Toriyama',
            'Hajime Isayama',
            'Kohei Horikoshi',
            'Koyoharu Gotouge',
            'Gege Akutami',
            'Sui Ishida',
            'Tsugumi Ohba',
            'Hiromu Arakawa',
            'Yoshihiro Togashi',
            'Naoko Takeuchi',
            'Natsuki Takaya',
            'Ai Yazawa',
            'Bisco Hatori',
            'Kentaro Miura',
            'Takehiko Inoue',
            'Makoto Yukimura',
            'Naoki Urasawa',
            'Tatsuya Endo',
            'Tatsuki Fujimoto',
            'Haruichi Furudate',
            'Takehiko Inoue',
            'Naoshi Arakawa',
            'Yoshitoki Oima',
            'Kaiu Shirai',
            'Akihito Tsukushi',
            'Tappei Nagatsuki',
            'Reki Kawahara',
        ];

        $publishers = [
            'Viz Media',
            'Kodansha Comics',
            'Yen Press',
            'Seven Seas Entertainment',
            'Dark Horse Comics',
            'Vertical Comics',
            'Square Enix Manga',
            'Tokyopop',
            'Shueisha',
            'Kadokawa',
        ];

        $genreIds = DB::table('genres')->pluck('id')->toArray();

        for ($i = 0; $i < count($mangaTitles); $i++) {
            $title = $mangaTitles[$i];
            $author = $authors[$i % count($authors)];
            $publisher = $publishers[$i % count($publishers)];
            
            $publicationDate = fake()->dateTimeBetween('-10 years', 'now')->format('Y-m-d');
            $price = fake()->randomFloat(2, 9.99, 29.99);
            
            // Insert the item
            $itemId = DB::table('items')->insertGetId([
                'title' => $title,
                'description' => fake()->paragraphs(3, true),
                'price' => $price,
                'author' => $author,
                'publisher' => $publisher,
                'publication_date' => $publicationDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Assign 1-3 random genres to each item
            $genreCount = rand(1, 3);
            $selectedGenres = array_rand(array_flip($genreIds), $genreCount);
            
            if (!is_array($selectedGenres)) {
                $selectedGenres = [$selectedGenres];
            }
            
            foreach ($selectedGenres as $genreId) {
                DB::table('genre_item')->insert([
                    'genre_id' => $genreId,
                    'item_id' => $itemId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}