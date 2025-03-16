<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Author;
use App\Models\Publisher;

class AuthorItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip if author_item already has entries
        if (DB::table('author_item')->count() > 0) {
            return;
        }

        $mangaData = [
            [
                'title' => 'One Piece Volume 1: Romance Dawn',
                'author' => 'Eiichiro Oda',
                'publisher' => 'Viz Media',
            ],
            [
                'title' => 'Naruto Volume 1: Uzumaki Naruto',
                'author' => 'Masashi Kishimoto',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Bleach Volume 1: The Death and the Strawberry',
                'author' => 'Tite Kubo',
                'publisher' => 'Yen Press',
            ],
            [
                'title' => 'Dragon Ball Volume 1: The Monkey King',
                'author' => 'Akira Toriyama',
                'publisher' => 'Seven Seas Entertainment',
            ],
            [
                'title' => 'Attack on Titan Volume 1',
                'author' => 'Hajime Isayama',
                'publisher' => 'Dark Horse Comics',
            ],
            [
                'title' => 'My Hero Academia Volume 1: Izuku Midoriya: Origin',
                'author' => 'Kohei Horikoshi',
                'publisher' => 'Vertical Comics',
            ],
            [
                'title' => 'Demon Slayer Volume 1: Cruelty',
                'author' => 'Koyoharu Gotouge',
                'publisher' => 'Square Enix Manga',
            ],
            [
                'title' => 'Jujutsu Kaisen Volume 1',
                'author' => 'Gege Akutami',
                'publisher' => 'Tokyopop',
            ],
            [
                'title' => 'Tokyo Ghoul Volume 1',
                'author' => 'Sui Ishida',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Death Note Volume 1: Boredom',
                'author' => 'Tsugumi Ohba',
                'publisher' => 'Kadokawa',
                'coauthors' => [
                    ['name' => 'Takeshi Obata', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Fullmetal Alchemist Volume 1',
                'author' => 'Hiromu Arakawa',
                'publisher' => 'Viz Media',
            ],
            [
                'title' => 'Hunter x Hunter Volume 1',
                'author' => 'Yoshihiro Togashi',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Sailor Moon Volume 1',
                'author' => 'Naoko Takeuchi',
                'publisher' => 'Yen Press',
            ],
            [
                'title' => 'Fruits Basket Volume 1',
                'author' => 'Natsuki Takaya',
                'publisher' => 'Seven Seas Entertainment',
            ],
            [
                'title' => 'Nana Volume 1',
                'author' => 'Ai Yazawa',
                'publisher' => 'Dark Horse Comics',
            ],
            [
                'title' => 'Ouran High School Host Club Volume 1',
                'author' => 'Bisco Hatori',
                'publisher' => 'Vertical Comics',
            ],
            [
                'title' => 'Berserk Volume 1: The Black Swordsman',
                'author' => 'Kentaro Miura',
                'publisher' => 'Square Enix Manga',
            ],
            [
                'title' => 'Vagabond Volume 1',
                'author' => 'Takehiko Inoue',
                'publisher' => 'Tokyopop',
            ],
            [
                'title' => 'Vinland Saga Volume 1',
                'author' => 'Makoto Yukimura',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Monster Volume 1',
                'author' => 'Naoki Urasawa',
                'publisher' => 'Kadokawa',
            ],
            [
                'title' => 'Spy x Family Volume 1',
                'author' => 'Tatsuya Endo',
                'publisher' => 'Viz Media',
            ],
            [
                'title' => 'Chainsaw Man Volume 1',
                'author' => 'Tatsuki Fujimoto',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Haikyu!! Volume 1',
                'author' => 'Haruichi Furudate',
                'publisher' => 'Yen Press',
            ],
            [
                'title' => 'Slam Dunk Volume 1',
                'author' => 'Takehiko Inoue',
                'publisher' => 'Seven Seas Entertainment',
            ],
            [
                'title' => 'Your Lie in April Volume 1',
                'author' => 'Naoshi Arakawa',
                'publisher' => 'Dark Horse Comics',
            ],
            [
                'title' => 'A Silent Voice Volume 1',
                'author' => 'Yoshitoki Oima',
                'publisher' => 'Vertical Comics',
            ],
            [
                'title' => 'The Promised Neverland Volume 1',
                'author' => 'Kaiu Shirai',
                'publisher' => 'Square Enix Manga',
                'coauthors' => [
                    ['name' => 'Posuka Demizu', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Made in Abyss Volume 1',
                'author' => 'Akihito Tsukushi',
                'publisher' => 'Tokyopop',
            ],
            [
                'title' => 'Re:Zero Volume 1',
                'author' => 'Tappei Nagatsuki',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Sword Art Online Volume 1',
                'author' => 'Reki Kawahara',
                'publisher' => 'Kadokawa',
            ],
        ];

        $authors = Author::all()->keyBy('name');
        $publishers = Publisher::all()->keyBy('name');
        $items = Item::all();

        // Update publisher_id for all items
        foreach ($items as $item) {
            foreach ($mangaData as $mangaItem) {
                if ($mangaItem['title'] === $item->title) {
                    $publisherName = $mangaItem['publisher'];
                    if (isset($publishers[$publisherName])) {
                        $item->publisher_id = $publishers[$publisherName]->id;
                        $item->save();
                    }
                    
                    // Add author relationships
                    $authorName = $mangaItem['author'];
                    if (isset($authors[$authorName])) {
                        DB::table('author_item')->insert([
                            'author_id' => $authors[$authorName]->id,
                            'item_id' => $item->id,
                            'role' => 'Author',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                    
                    // Add co-authors if any
                    if (isset($mangaItem['coauthors'])) {
                        foreach ($mangaItem['coauthors'] as $coauthor) {
                            if (isset($authors[$coauthor['name']])) {
                                DB::table('author_item')->insert([
                                    'author_id' => $authors[$coauthor['name']]->id,
                                    'item_id' => $item->id,
                                    'role' => $coauthor['role'],
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                    
                    break;
                }
            }
        }
    }
}

