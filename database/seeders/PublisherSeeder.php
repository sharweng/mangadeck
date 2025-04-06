<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Publisher;
use App\Models\Item;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        // Check if publishers already exist
        $existingCount = DB::table('publishers')->count();
        
        $publishers = [
            [
                'name' => 'Viz Media',
                'description' => 'One of the largest publishers of manga in the United States.',
                'country' => 'United States',
                'website' => 'https://www.viz.com',
            ],
            [
                'name' => 'Kodansha Comics',
                'description' => 'The English-language publishing arm of Kodansha, one of Japan\'s largest publishers. Known for publishing Attack on Titan, Vinland Saga, and many other popular manga series.',
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
                'description' => 'One of the largest publishing companies in Japan. Publisher of Weekly Shonen Jump and home to many popular manga series including Haikyu!!, Slam Dunk, One Piece, and Naruto.',
                'country' => 'Japan',
                'website' => 'https://www.shueisha.co.jp',
            ],
            [
                'name' => 'Kadokawa',
                'description' => 'A major Japanese publishing company that produces manga and light novels.',
                'country' => 'Japan',
                'website' => 'https://www.kadokawa.co.jp',
            ],
            [
                'name' => 'Shogakukan',
                'description' => 'One of the largest publishers in Japan, known for Weekly Shonen Sunday.',
                'country' => 'Japan',
                'website' => 'https://www.shogakukan.co.jp',
            ],
            [
                'name' => 'Hakusensha',
                'description' => 'Japanese publisher known for seinen and shoujo manga. Publisher of Berserk by Kentaro Miura and other acclaimed manga series.',
                'country' => 'Japan',
                'website' => 'https://www.hakusensha.co.jp',
            ],
            [
                'name' => 'Futabasha',
                'description' => 'Japanese publisher known for seinen manga.',
                'country' => 'Japan',
                'website' => 'https://www.futabasha.co.jp',
            ],
            [
                'name' => 'Akita Shoten',
                'description' => 'Japanese publisher of Weekly Shonen Champion.',
                'country' => 'Japan',
                'website' => 'https://www.akitashoten.co.jp',
            ],
            [
                'name' => 'Shinshokan',
                'description' => 'Japanese publisher known for BL (Boys\' Love) manga and light novels.',
                'country' => 'Japan',
                'website' => 'https://www.shinshokan.co.jp',
            ],
            [
                'name' => 'Takeshobo',
                'description' => 'Japanese publisher known for seinen manga and comedy titles.',
                'country' => 'Japan',
                'website' => 'https://www.takeshobo.co.jp',
            ],
        ];

        // If no publishers exist, create them all
        if ($existingCount === 0) {
            foreach ($publishers as $publisher) {
                Publisher::create($publisher);
            }
        } else {
            // Otherwise, update existing publishers and add missing ones
            $this->updateExistingPublishers($publishers);
        }
        
        // Fix publisher associations for specific manga titles
        $this->fixPublisherAssociations();
    }

    /**
     * Update existing publishers and add missing ones
     */
    private function updateExistingPublishers(array $publishers): void
    {
        $existingPublishers = Publisher::all()->keyBy('name');
        
        foreach ($publishers as $publisherData) {
            $name = $publisherData['name'];
            
            if (isset($existingPublishers[$name])) {
                // Update existing publisher
                $existingPublishers[$name]->update($publisherData);
            } else {
                // Create new publisher
                Publisher::create($publisherData);
            }
        }
    }
    
    /**
     * Fix publisher associations for specific manga titles
     */
    private function fixPublisherAssociations(): void
    {
        // Get publishers by name
        $publishers = Publisher::all()->keyBy('name');
        
        // Define manga titles and their correct publishers
        $mangaPublishers = [
            'Berserk' => 'Hakusensha',
            'Attack on Titan' => 'Kodansha Comics',
            'Vinland Saga' => 'Kodansha Comics',
            'Haikyu!!' => 'Shueisha',
            'Slam Dunk' => 'Shueisha',
            // Add more manga titles and publishers as needed
        ];
        
        // Update publisher associations
        foreach ($mangaPublishers as $title => $publisherName) {
            if (!isset($publishers[$publisherName])) {
                continue; // Skip if publisher doesn't exist
            }
            
            // Find manga by title (using LIKE for partial matches)
            $items = Item::where('title', 'LIKE', "%$title%")->get();
            
            foreach ($items as $item) {
                $item->update([
                    'publisher_id' => $publishers[$publisherName]->id
                ]);
            }
        }
        
        // Ensure all manga have a publisher
        $itemsWithoutPublisher = Item::whereNull('publisher_id')->get();
        
        foreach ($itemsWithoutPublisher as $item) {
            // Try to find a matching publisher from the manga data
            foreach ($this->getMangaData() as $manga) {
                if (stripos($item->title, $manga['title']) !== false && isset($publishers[$manga['publisher']])) {
                    $item->update([
                        'publisher_id' => $publishers[$manga['publisher']]->id
                    ]);
                    break;
                }
            }
        }
    }
    
    /**
     * Get manga data from ItemSeeder
     */
    private function getMangaData(): array
    {
        return [
            ['title' => 'Kagurabachi', 'publisher' => 'Shueisha'],
            ['title' => 'Ranking of Kings', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Seraph of the End', 'publisher' => 'Viz Media'],
            ['title' => 'Attack on Titan', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Blue Box', 'publisher' => 'Shueisha'],
            ['title' => 'The Fragrant Flower', 'publisher' => 'Kodansha Comics'],
            ['title' => 'The Angel Next Door', 'publisher' => 'Kadokawa'],
            ['title' => 'My Dress-Up Darling', 'publisher' => 'Square Enix Manga'],
            ['title' => 'My Girlfriend is the best', 'publisher' => 'Shogakukan'],
            ['title' => 'A Sign of Affection', 'publisher' => 'Hakusensha'],
            ['title' => 'Kimi ni Todoke', 'publisher' => 'Shueisha'],
            ['title' => 'Ao Haru Ride', 'publisher' => 'Shueisha'],
            ['title' => 'My Happy Marriage', 'publisher' => 'Kadokawa'],
            ['title' => 'Berserk', 'publisher' => 'Hakusensha'],
            ['title' => 'Vinland Saga', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Goodnight Punpun', 'publisher' => 'Shogakukan'],
            ['title' => 'Classroom of the Elite', 'publisher' => 'Kadokawa'],
            ['title' => 'Loving Yamada', 'publisher' => 'Hakusensha'],
            ['title' => 'I Think I Turned My Childhood Friend', 'publisher' => 'Futabasha'],
            ['title' => 'Wotakoi', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Given', 'publisher' => 'Shinshokan'],
            ['title' => 'That Time I Got Reincarnated as a Slime', 'publisher' => 'Kodansha Comics'],
            ['title' => 'The Eminence in Shadow', 'publisher' => 'Kadokawa'],
            ['title' => 'Tsukimichi', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Overlord', 'publisher' => 'Kadokawa'],
            ['title' => 'Neon Genesis Evangelion', 'publisher' => 'Kadokawa'],
            ['title' => 'DARLING in the FRANXX', 'publisher' => 'Shueisha'],
            ['title' => 'Mobile Suit Gundam', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Tengen Toppa Gurren Lagann', 'publisher' => 'Kadokawa'],
            ['title' => 'Mieruko-chan', 'publisher' => 'Kadokawa'],
            ['title' => 'Dark Gathering', 'publisher' => 'Shueisha'],
            ['title' => 'The Hundred Ghost Stories', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Ajin', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Blue Lock', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Haikyu', 'publisher' => 'Shueisha'],
            ['title' => 'Slam Dunk', 'publisher' => 'Shueisha'],
            ['title' => 'Hajime no Ippo', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Black Clover', 'publisher' => 'Shueisha'],
            ['title' => 'Record of Ragnarok', 'publisher' => 'Kodansha Comics'],
            ['title' => 'Wistoria', 'publisher' => 'Kodansha Comics'],
            ['title' => 'The Seven Deadly Sins', 'publisher' => 'Kodansha Comics'],
        ];
    }
}