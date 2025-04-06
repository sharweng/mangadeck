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
            // Shounen
            [
                'title' => 'Kagurabachi',
                'author' => 'Takeru Hokazono',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Ranking of Kings',
                'author' => 'Sousuke Tooka',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Seraph of the End: Vampire Reign',
                'author' => 'Takaya Kagami',
                'publisher' => 'Viz Media',
                'coauthors' => [
                    ['name' => 'Yamato Yamamoto', 'role' => 'Illustrator'],
                    ['name' => 'Daisuke Furuya', 'role' => 'Collaborator']
                ]
            ],
            [
                'title' => 'Attack on Titan',
                'author' => 'Hajime Isayama',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'One Piece',
                'author' => 'Eiichiro Oda',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Naruto',
                'author' => 'Masashi Kishimoto',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Bleach',
                'author' => 'Tite Kubo',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Dragon Ball',
                'author' => 'Akira Toriyama',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'My Hero Academia',
                'author' => 'Kōhei Horikoshi',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Demon Slayer',
                'author' => 'Koyoharu Gotouge',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Jujutsu Kaisen',
                'author' => 'Gege Akutami',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Black Clover',
                'author' => 'Yuuki Tabata',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Blue Lock',
                'author' => 'Muneyuki Kaneshiro',
                'publisher' => 'Kodansha Comics',
                'coauthors' => [
                    ['name' => 'Yuusuke Nomura', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Record of Ragnarok',
                'author' => 'Takumi Fukui',
                'publisher' => 'Kodansha Comics',
                'coauthors' => [
                    ['name' => 'Shinya Umemura', 'role' => 'Writer'],
                    ['name' => 'Ajichika', 'role' => 'Illustrator']
                ]
            ],
            
            // Romance
            [
                'title' => 'Blue Box',
                'author' => 'Kouji Miura',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'The Fragrant Flower Blooms With Dignity',
                'author' => 'Saka Mikami',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'The Angel Next Door Spoils Me Rotten',
                'author' => 'Saeki-san',
                'publisher' => 'Kadokawa',
                'coauthors' => [
                    ['name' => 'Wan Shibata', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'My Dress-Up Darling',
                'author' => 'Shinichi Fukuda',
                'publisher' => 'Square Enix Manga',
            ],
            [
                'title' => 'My Girlfriend is the best!',
                'author' => 'Iori',
                'publisher' => 'Shogakukan',
                'coauthors' => [
                    ['name' => 'Takami Takada', 'role' => 'Illustrator']
                ]
            ],
            
            // Shojo
            [
                'title' => 'A Sign of Affection',
                'author' => 'Suu Morishita',
                'publisher' => 'Hakusensha',
            ],
            [
                'title' => 'Kimi ni Todoke: From Me to You',
                'author' => 'Karuho Shiina',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Ao Haru Ride',
                'author' => 'Io Sakisaka',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'My Happy Marriage',
                'author' => 'Akumi Agitogi',
                'publisher' => 'Kadokawa',
                'coauthors' => [
                    ['name' => 'Rito Kousaka', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Fruits Basket',
                'author' => 'Natsuki Takaya',
                'publisher' => 'Hakusensha',
            ],
            [
                'title' => 'Sailor Moon',
                'author' => 'Naoko Takeuchi',
                'publisher' => 'Kodansha Comics',
            ],
            
            // Seinen
            [
                'title' => 'Berserk',
                'author' => 'Kentaro Miura',
                'publisher' => 'Hakusensha',
                'coauthors' => [
                    ['name' => 'Studio Gaga', 'role' => 'Studio']
                ]
            ],
            [
                'title' => 'Vinland Saga',
                'author' => 'Makoto Yukimura',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Goodnight Punpun',
                'author' => 'Inio Asano',
                'publisher' => 'Shogakukan',
            ],
            [
                'title' => 'Classroom of the Elite',
                'author' => 'Shougo Kinugasa',
                'publisher' => 'Kadokawa',
                'coauthors' => [
                    ['name' => 'Yuyu Ichino', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Tokyo Ghoul',
                'author' => 'Sui Ishida',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Death Note',
                'author' => 'Tsugumi Ohba',
                'publisher' => 'Shueisha',
                'coauthors' => [
                    ['name' => 'Takeshi Obata', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Monster',
                'author' => 'Naoki Urasawa',
                'publisher' => 'Shogakukan',
            ],
            [
                'title' => 'Vagabond',
                'author' => 'Takehiko Inoue',
                'publisher' => 'Kodansha Comics',
            ],
            
            // Josei
            [
                'title' => 'Loving Yamada at LV999!',
                'author' => 'Mashiro',
                'publisher' => 'Hakusensha',
            ],
            [
                'title' => 'I Think I Turned My Childhood Friend Into a Girl',
                'author' => 'Azusa Banjou',
                'publisher' => 'Futabasha',
            ],
            [
                'title' => 'Wotakoi: Love is Hard for Otaku',
                'author' => 'Fujita',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Given',
                'author' => 'Natsuki Kizu',
                'publisher' => 'Shinshokan',
            ],
            [
                'title' => 'Nana',
                'author' => 'Ai Yazawa',
                'publisher' => 'Shueisha',
            ],
            
            // Isekai
            [
                'title' => 'That Time I Got Reincarnated as a Slime',
                'author' => 'Fuse',
                'publisher' => 'Kodansha Comics',
                'coauthors' => [
                    ['name' => 'Taiki Kawakami', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'The Eminence in Shadow',
                'author' => 'Daisuke Aizawa',
                'publisher' => 'Kadokawa',
                'coauthors' => [
                    ['name' => 'Anri Sakano', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Tsukimichi: Moonlit Fantasy',
                'author' => 'Kei Azumi',
                'publisher' => 'Kodansha Comics',
                'coauthors' => [
                    ['name' => 'Kotora Kino', 'role' => 'Writer']
                ]
            ],
            [
                'title' => 'Overlord',
                'author' => 'Kugane Maruyama',
                'publisher' => 'Kadokawa',
                'coauthors' => [
                    ['name' => 'Fugin Miyama', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Re:Zero',
                'author' => 'Tappei Nagatsuki',
                'publisher' => 'Kadokawa',
            ],
            [
                'title' => 'Sword Art Online',
                'author' => 'Reki Kawahara',
                'publisher' => 'Kadokawa',
            ],
            
            // Mecha
            [
                'title' => 'Neon Genesis Evangelion',
                'author' => 'Yoshiyuki Sadamoto',
                'publisher' => 'Kadokawa',
            ],
            [
                'title' => 'DARLING in the FRANXX',
                'author' => 'Code:000',
                'publisher' => 'Shueisha',
                'coauthors' => [
                    ['name' => 'Kentarou Yabuki', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Mobile Suit Gundam: The Origin',
                'author' => 'Yoshiyuki Tomino',
                'publisher' => 'Kodansha Comics',
                'coauthors' => [
                    ['name' => 'Yoshikazu Yasuhiko', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Tengen Toppa Gurren Lagann',
                'author' => 'Kazuki Nakashima',
                'publisher' => 'Kadokawa',
                'coauthors' => [
                    ['name' => 'Kotarou Mori', 'role' => 'Illustrator']
                ]
            ],
            
            // Horror
            [
                'title' => 'Mieruko-chan',
                'author' => 'Tomoki Izumi',
                'publisher' => 'Kadokawa',
            ],
            [
                'title' => 'Dark Gathering',
                'author' => 'Kenichi Kondou',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'The Hundred Ghost Stories That Led to My Death',
                'author' => 'Anji Matono',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Ajin: Demi-Human',
                'author' => 'Tsuina Miura',
                'publisher' => 'Kodansha Comics',
                'coauthors' => [
                    ['name' => 'Gamon Sakurai', 'role' => 'Illustrator']
                ]
            ],
            
            // Sports
            [
                'title' => 'Haikyu!!',
                'author' => 'Haruichi Furudate',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Slam Dunk',
                'author' => 'Takehiko Inoue',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Hajime no Ippo',
                'author' => 'George Morikawa',
                'publisher' => 'Kodansha Comics',
            ],
            
            // Fantasy
            [
                'title' => 'Wistoria: Wand and Sword',
                'author' => 'Fujino Omori',
                'publisher' => 'Kodansha Comics',
                'coauthors' => [
                    ['name' => 'Toshi Aoi', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'The Seven Deadly Sins',
                'author' => 'Nakaba Suzuki',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'Fullmetal Alchemist',
                'author' => 'Hiromu Arakawa',
                'publisher' => 'Square Enix',
            ],
            
            // Other notable titles
            [
                'title' => 'Hunter x Hunter',
                'author' => 'Yoshihiro Togashi',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Ouran High School Host Club',
                'author' => 'Bisco Hatori',
                'publisher' => 'Hakusensha',
            ],
            [
                'title' => 'Spy x Family',
                'author' => 'Tatsuya Endo',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Chainsaw Man',
                'author' => 'Tatsuki Fujimoto',
                'publisher' => 'Shueisha',
            ],
            [
                'title' => 'Your Lie in April',
                'author' => 'Naoshi Arakawa',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'A Silent Voice',
                'author' => 'Yoshitoki Oima',
                'publisher' => 'Kodansha Comics',
            ],
            [
                'title' => 'The Promised Neverland',
                'author' => 'Kaiu Shirai',
                'publisher' => 'Shueisha',
                'coauthors' => [
                    ['name' => 'Posuka Demizu', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Made in Abyss',
                'author' => 'Akihito Tsukushi',
                'publisher' => 'Takeshobo',
            ]
        ];

        $authors = Author::all()->keyBy('name');
        $publishers = Publisher::all()->keyBy('name');
        $items = Item::all()->keyBy('title');

        foreach ($mangaData as $mangaItem) {
            if (!isset($items[$mangaItem['title']])) {
                continue;
            }

            $item = $items[$mangaItem['title']];
            
            // Update publisher
            if (isset($publishers[$mangaItem['publisher']])) {
                $item->publisher_id = $publishers[$mangaItem['publisher']]->id;
                $item->save();
            }
            
            // Add main author relationship
            if (isset($authors[$mangaItem['author']])) {
                DB::table('author_item')->insert([
                    'author_id' => $authors[$mangaItem['author']]->id,
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
        }
    }
}