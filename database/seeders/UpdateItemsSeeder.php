<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Publisher;

class UpdateItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mangaData = [
            [
                'title' => 'One Piece Volume 1: Romance Dawn',
                'publisher' => 'Viz Media',
            ],
            [
                'title' => 'Naruto Volume 1: Uzumaki Naruto',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Bleach Volume 1: The Death and the Strawberry',
                'publisher' => 'Yen Press',
            ],
            [
                'title' => 'Dragon Ball Volume 1: The Monkey King',
                'publisher' => 'Seven Seas Entertainment',
            ],
            [
                'title' => 'Attack on Titan Volume 1',
                'publisher' => 'Dark Horse Comics',
            ],
            [
                'title' => 'My Hero Academia Volume 1: Izuku Midoriya: Origin',
                'publisher' => 'Vertical Comics',
            ],
            [
                'title' => 'Demon Slayer Volume 1: Cruelty',
                'publisher' => 'Square Enix Manga',
            ],
            [
                'title' => 'Jujutsu Kaisen Volume 1',
                'publisher' => 'Tokyopop',
            ],
            [
                'title' => 'Tokyo Ghoul Volume 1',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Death Note Volume 1: Boredom',
                'publisher' => 'Kadokawa',
            ],
            [
                'title' => 'Fullmetal Alchemist Volume 1',
                'publisher' => 'Viz Media',
            ],
            [
                'title' => 'Hunter x Hunter Volume 1',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Sailor Moon Volume 1',
                'publisher' => 'Yen Press',
            ],
            [
                'title' => 'Fruits Basket Volume 1',
                'publisher' => 'Seven Seas Entertainment',
            ],
            [
                'title' => 'Nana Volume 1',
                'publisher' => 'Dark Horse Comics',
            ],
            [
                'title' => 'Ouran High School Host Club Volume 1',
                'publisher' => 'Vertical Comics',
            ],
            [
                'title' => 'Berserk Volume 1: The Black Swordsman',
                'publisher' => 'Square Enix Manga',
            ],
            [
                'title' => 'Vagabond Volume 1',
                'publisher' => 'Tokyopop',
            ],
            [
                'title' => 'Vinland Saga Volume 1',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Monster Volume 1',
                'publisher' => 'Kadokawa',
            ],
            [
                'title' => 'Spy x Family Volume 1',
                'publisher' => 'Viz Media',
            ],
            [
                'title' => 'Chainsaw Man Volume 1',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Haikyu!! Volume 1',
                'publisher' => 'Yen Press',
            ],
            [
                'title' => 'Slam Dunk Volume 1',
                'publisher' => 'Seven Seas Entertainment',
            ],
            [
                'title' => 'Your Lie in April Volume 1',
                'publisher' => 'Dark Horse Comics',
            ],
            [
                'title' => 'A Silent Voice Volume 1',
                'publisher' => 'Vertical Comics',
            ],
            [
                'title' => 'The Promised Neverland Volume 1',
                'publisher' => 'Square Enix Manga',
            ],
            [
                'title' => 'Made in Abyss Volume 1',
                'publisher' => 'Tokyopop',
            ],
            [
                'title' => 'Re:Zero Volume 1',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Sword Art Online Volume 1',
                'publisher' => 'Kadokawa',
            ],
        ];

        $publishers = Publisher::all()->keyBy('name');
        
        // Update publisher_id for all items
        foreach (Item::all() as $item) {
            foreach ($mangaData as $mangaItem) {
                if ($mangaItem['title'] === $item->title) {
                    $publisherName = $mangaItem['publisher'];
                    if (isset($publishers[$publisherName])) {
                        $item->publisher_id = $publishers[$publisherName]->id;
                        $item->save();
                        
                        echo "Updated publisher for: {$item->title}\n";
                    }
                    break;
                }
            }
        }
    }
}

