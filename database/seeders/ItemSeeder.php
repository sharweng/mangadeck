<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Publisher;
use App\Models\Author;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $faker->seed(1234); // Consistent results between runs

        $mangaData = [
            // Shounen
            [
                'title' => 'Kagurabachi',
                'author' => 'Takeru Hokazono',
                'publisher' => 'Shueisha',
                'synopsis' => 'As a young boy, Chihiro trains every day under his father to become a swordsmith. Although different in temperament, the two spend peaceful days laughing and working together. But one day, tragedy strikes… Now Chihiro burns with hatred and sets out to exact revenge.',
                'genres' => ['Shounen', 'Action', 'Drama', 'Dark Fantasy']
            ],
            [
                'title' => 'Ranking of Kings',
                'author' => 'Sousuke Tooka',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'The people of the kingdom look down on the young Prince Bojji, who can neither hear nor speak. They call him "The Useless Prince" while jeering at his supposed foolishness. However, while Bojji may not be physically strong, he is certainly not weak of heart.',
                'genres' => ['Shounen', 'Action', 'Comedy', 'Demons', 'Adventure', 'Fantasy', 'Magic']
            ],
            [
                'title' => 'Seraph of the End: Vampire Reign',
                'author' => 'Takaya Kagami',
                'publisher' => 'Viz Media',
                'synopsis' => 'Set in a world where a deadly virus has wiped out most of humanity, allowing vampires to enslave the rest of the human race. It tells the story of an orphaned boy named Yūichirō Hyakuya trying to rid the world of the vampires by joining the Japanese Imperial Demon Army.',
                'genres' => ['Shounen', 'Action', 'Drama', 'Mystery', 'Vampire', 'School', 'Supernatural', 'Demons', 'Military'],
                'coauthors' => [
                    ['name' => 'Yamato Yamamoto', 'role' => 'Illustrator'],
                    ['name' => 'Daisuke Furuya', 'role' => 'Collaborator']
                ]
            ],
            [
                'title' => 'Attack on Titan',
                'author' => 'Hajime Isayama',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Set in a world where humanity is on the brink of extinction due to giant humanoid creatures called Titans. The story follows Eren Yeager, who vows to eradicate the Titans after they destroy his hometown and kill his mother.',
                'genres' => ['Shounen', 'Action', 'Drama', 'Mystery', 'Super Power', 'Fantasy', 'Military', 'Dark Fantasy']
            ],
            
            // Romance
            [
                'title' => 'Blue Box',
                'author' => 'Kouji Miura',
                'publisher' => 'Shueisha',
                'synopsis' => 'The story is centered around Taiki, a rookie badminton player, who is suddenly unexpectedly brought closer to his long-time crush, Chinatsu, a star on the basketball team.',
                'genres' => ['Romance', 'Shounen', 'Sports', 'School', 'Slice of Life']
            ],
            [
                'title' => 'The Fragrant Flower Blooms With Dignity',
                'author' => 'Saka Mikami',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Chidori second-year Rintaro, who has a fierce face but a gentle heart, is helping at his family\'s patisserie when he meets a girl named Kaoruko.',
                'genres' => ['Romance', 'Shounen', 'School', 'Comedy', 'Drama']
            ],
            [
                'title' => 'The Angel Next Door Spoils Me Rotten',
                'author' => 'Saeki-san',
                'publisher' => 'Kadokawa',
                'synopsis' => 'Described as an "angel" by her peers, Mahiru is a stunning girl who excels both academically and athletically. While Amane, an average and messy individual, attends the same school as her.',
                'genres' => ['Romance', 'School', 'Slice of Life', 'Comedy'],
                'coauthors' => [
                    ['name' => 'Wan Shibata', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'My Dress-Up Darling',
                'author' => 'Shinichi Fukuda',
                'publisher' => 'Square Enix Manga',
                'synopsis' => 'A loner boy and a flashy girl find common ground via cosplay in this sweet and spicy rom-com!',
                'genres' => ['Romance', 'School', 'Seinen', 'Slice of Life', 'Comedy', 'Ecchi']
            ],
            [
                'title' => 'My Girlfriend is the best!',
                'author' => 'Iori',
                'publisher' => 'Shogakukan',
                'synopsis' => 'After separating from his girlfriend, the boy is feeling hopeless. However, his tomboyish friend proposes an unexpected solution: why not date each other?',
                'genres' => ['Romance', 'Shounen', 'Slice of Life', 'Comedy'],
                'coauthors' => [
                    ['name' => 'Takami Takada', 'role' => 'Illustrator']
                ]
            ],
            
            // Shojo
            [
                'title' => 'A Sign of Affection',
                'author' => 'Suu Morishita',
                'publisher' => 'Hakusensha',
                'synopsis' => 'The story centres around university student Yuki Itose, a second-year who communicates through Japanese Sign Language due to being deaf since birth.',
                'genres' => ['Shoujo', 'Romance', 'Slice of Life']
            ],
            [
                'title' => 'Kimi ni Todoke: From Me to You',
                'author' => 'Karuho Shiina',
                'publisher' => 'Shueisha',
                'synopsis' => 'A girl named Kuronuma Sawako. She is nicknamed Sadako (from "The Ring") because many people see her as strange and often mistake her for a ghost.',
                'genres' => ['Shoujo', 'Comedy', 'Drama', 'Romance', 'School', 'Slice of Life']
            ],
            [
                'title' => 'Ao Haru Ride',
                'author' => 'Io Sakisaka',
                'publisher' => 'Shueisha',
                'synopsis' => 'Revolves around Futaba, a girl who was in love with a boy named Ko Tanaka in middle school. However, it did not work because he transferred but in high school, her world is turned around once again when she meets him again.',
                'genres' => ['Shoujo', 'Comedy', 'Drama', 'Romance', 'School', 'Slice of Life']
            ],
            [
                'title' => 'My Happy Marriage',
                'author' => 'Akumi Agitogi',
                'publisher' => 'Kadokawa',
                'synopsis' => 'Born to a noble family, Miyo is raised by her abusive stepmother and married off to Kiyoka, a soldier so heartless his prior fiancées fled within three days into their engagement.',
                'genres' => ['Shoujo', 'Drama', 'Romance', 'Super Power', 'Supernatural'],
                'coauthors' => [
                    ['name' => 'Rito Kousaka', 'role' => 'Illustrator']
                ]
            ],
            
            // Seinen
            [
                'title' => 'Berserk',
                'author' => 'Kentaro Miura',
                'publisher' => 'Hakusensha',
                'synopsis' => 'Berserk is a story that follows the story of Guts; a swordsman whose very existence has been Hell since he was born.',
                'genres' => ['Seinen', 'Action', 'Drama', 'Super Power', 'Supernatural', 'Demons', 'Adventure', 'Fantasy', 'Horror', 'Military', 'Psychological', 'Magic', 'Dark Fantasy'],
                'coauthors' => [
                    ['name' => 'Studio Gaga', 'role' => 'Studio']
                ]
            ],
            [
                'title' => 'Vinland Saga',
                'author' => 'Makoto Yukimura',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'A young man named Thorfinn finds himself in a quest for revenge against the man responsible for a traumatic tragedy in his early life.',
                'genres' => ['Seinen', 'Action', 'Drama', 'Adventure', 'Iyashikei', 'Historical']
            ],
            [
                'title' => 'Goodnight Punpun',
                'author' => 'Inio Asano',
                'publisher' => 'Shogakukan',
                'synopsis' => 'Meet Punpun Onodera, an ordinary 11-year-old boy from Japan. He sees life through a hopeless romantic lens and his outlook changes forever when he meets Aiko Tanaka, his new classmate.',
                'genres' => ['Seinen', 'Drama', 'School', 'Psychological', 'Slice of Life']
            ],
            [
                'title' => 'Classroom of the Elite',
                'author' => 'Shougo Kinugasa',
                'publisher' => 'Kadokawa',
                'synopsis' => 'Classroom of the Elite is a psychological thriller and school-based anime/light novel series set in the prestigious Tokyo Metropolitan Advanced Nurturing High School.',
                'genres' => ['Seinen', 'Comedy', 'Drama', 'Mystery', 'Romance', 'School', 'Psychological'],
                'coauthors' => [
                    ['name' => 'Yuyu Ichino', 'role' => 'Illustrator']
                ]
            ],
            
            // Josei
            [
                'title' => 'Loving Yamada at LV999!',
                'author' => 'Mashiro',
                'publisher' => 'Hakusensha',
                'synopsis' => 'Akane Kinoshita discovered the complexities of online relationships after her gamer boyfriend\'s infidelity with a fellow player.',
                'genres' => ['Josei', 'Comedy', 'Drama', 'Romance']
            ],
            [
                'title' => 'I Think I Turned My Childhood Friend Into a Girl',
                'author' => 'Azusa Banjou',
                'publisher' => 'Futabasha',
                'synopsis' => 'Despite being a male, Kenshirou Midou has a fascination with cosmetics that he keeps hidden from his peers, except for his sisters and childhood friend, Hiura Mihate.',
                'genres' => ['Josei', 'Boys Love', 'Comedy', 'Romance', 'School']
            ],
            [
                'title' => 'Wotakoi: Love is Hard for Otaku',
                'author' => 'Fujita',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Follows the story of Narumi Momose, a cheerful office worker who secretly loves anime and BL (Boys\' Love) manga.',
                'genres' => ['Josei', 'Comedy', 'Romance', 'Iyashikei', 'Slice of Life']
            ],
            [
                'title' => 'Given',
                'author' => 'Natsuki Kizu',
                'publisher' => 'Shinshokan',
                'synopsis' => 'The story follows Mafuyu Satou, a quiet high school student who carries an old guitar with him but doesn\'t know how to play.',
                'genres' => ['Josei', 'Boys Love', 'Drama', 'Music', 'Romance', 'School', 'Slice of Life']
            ],
            
            // Isekai
            [
                'title' => 'That Time I Got Reincarnated as a Slime',
                'author' => 'Fuse',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Follows Satoru Mikami, a middle-aged office worker who is killed in a stabbing incident and reincarnates in a fantasy world—as a slime!',
                'genres' => ['Isekai', 'Action', 'Comedy', 'Shounen', 'Demons', 'Adventure', 'Fantasy', 'Magic'],
                'coauthors' => [
                    ['name' => 'Taiki Kawakami', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'The Eminence in Shadow',
                'author' => 'Daisuke Aizawa',
                'publisher' => 'Kadokawa',
                'synopsis' => 'Follows Cid Kagenou, a boy obsessed with operating from the shadows like a mastermind controlling events from behind the scenes.',
                'genres' => ['Isekai', 'Action', 'Comedy', 'Parody', 'Shounen', 'Vampire', 'Fantasy', 'Magic'],
                'coauthors' => [
                    ['name' => 'Anri Sakano', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Tsukimichi: Moonlit Fantasy',
                'author' => 'Kei Azumi',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Summoned by the god Tsukuyomi to become a hero in a fantasy world, Misumi Makoto, a high school student, faces opposition from powerful beings.',
                'genres' => ['Isekai', 'Action', 'Comedy', 'Shounen', 'Supernatural', 'Adventure', 'Fantasy', 'Magic'],
                'coauthors' => [
                    ['name' => 'Kotora Kino', 'role' => 'Writer']
                ]
            ],
            [
                'title' => 'Overlord',
                'author' => 'Kugane Maruyama',
                'publisher' => 'Kadokawa',
                'synopsis' => 'It follows Suzuki Satoru, a salaryman who gets trapped inside his favorite MMORPG, Yggdrasil, when the game\'s servers shut down.',
                'genres' => ['Isekai', 'Action', 'Comedy', 'Parody', 'Vampire', 'Supernatural', 'Demons', 'Adventure', 'Fantasy', 'Magic'],
                'coauthors' => [
                    ['name' => 'Fugin Miyama', 'role' => 'Illustrator']
                ]
            ],
            
            // Mecha
            [
                'title' => 'Neon Genesis Evangelion',
                'author' => 'Yoshiyuki Sadamoto',
                'publisher' => 'Kadokawa',
                'synopsis' => 'A psychological mecha anime set in a post-apocalyptic world where humanity battles mysterious beings called Angels.',
                'genres' => ['Mecha', 'Action', 'Drama', 'Mystery', 'Sci-Fi', 'Shounen', 'Psychological', 'Seinen']
            ],
            [
                'title' => 'DARLING in the FRANXX',
                'author' => 'Code:000',
                'publisher' => 'Shueisha',
                'synopsis' => 'A sci-fi mecha anime set in a dystopian future where humanity is on the brink of extinction due to mysterious creatures called Klaxosaurs.',
                'genres' => ['Mecha', 'Drama', 'Ecchi', 'Romance', 'Sci-Fi', 'Shounen'],
                'coauthors' => [
                    ['name' => 'Kentarou Yabuki', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Mobile Suit Gundam: The Origin',
                'author' => 'Yoshiyuki Tomino',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Commander Char Aznable, an ace pilot for Zeon, believed he could thwart the Federation\'s mobile suit construction.',
                'genres' => ['Mecha', 'Action', 'Drama', 'Sci-Fi', 'Shounen', 'Space', 'Military'],
                'coauthors' => [
                    ['name' => 'Yoshikazu Yasuhiko', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Tengen Toppa Gurren Lagann',
                'author' => 'Kazuki Nakashima',
                'publisher' => 'Kadokawa',
                'synopsis' => 'Kamina and Simon feel constricted by the restrictions imposed by their village elder in their secluded underground community.',
                'genres' => ['Mecha', 'Action', 'Comedy', 'Romance', 'Sci-Fi', 'Shounen', 'Space', 'Adventure'],
                'coauthors' => [
                    ['name' => 'Kotarou Mori', 'role' => 'Illustrator']
                ]
            ],
            
            // Horror
            [
                'title' => 'Mieruko-chan',
                'author' => 'Tomoki Izumi',
                'publisher' => 'Kadokawa',
                'synopsis' => 'Follows Miko Yotsuya, an ordinary high school girl who suddenly gains the terrifying ability to see grotesque and horrifying spirits that lurk around people.',
                'genres' => ['Horror', 'Comedy', 'School', 'Supernatural', 'Seinen', 'Slice of Life']
            ],
            [
                'title' => 'Dark Gathering',
                'author' => 'Kenichi Kondou',
                'publisher' => 'Shueisha',
                'synopsis' => 'A Japanese horror anime and manga series following Keitarō Gentōga, a young man with a strong sensitivity to spirits.',
                'genres' => ['Horror', 'Shounen', 'Supernatural']
            ],
            [
                'title' => 'The Hundred Ghost Stories That Led to My Death',
                'author' => 'Anji Matono',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'This anthology horror series tells the tale of the "Round of 100 Ghost Stories," a legendary folktale that tests one\'s courage.',
                'genres' => ['Horror', 'Mystery', 'Shounen', 'Supernatural', 'Psychological']
            ],
            [
                'title' => 'Ajin: Demi-Human',
                'author' => 'Tsuina Miura',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Kei Nagai, a high school student who discovers he is an "Ajin" after surviving a fatal accident.',
                'genres' => ['Horror', 'Action', 'Mystery', 'Super Power', 'Supernatural', 'Military', 'Seinen'],
                'coauthors' => [
                    ['name' => 'Gamon Sakurai', 'role' => 'Illustrator']
                ]
            ],
            
            // Sports
            [
                'title' => 'Blue Lock',
                'author' => 'Muneyuki Kaneshiro',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Centered around Yoichi Isagi, a high school soccer player who joins the controversial Blue Lock program.',
                'genres' => ['Sports', 'Action', 'Drama', 'Shounen'],
                'coauthors' => [
                    ['name' => 'Yuusuke Nomura', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Haikyu!!',
                'author' => 'Haruichi Furudate',
                'publisher' => 'Shueisha',
                'synopsis' => 'Follows Shoyo Hinata, a determined but short volleyball player inspired by the "Little Giant."',
                'genres' => ['Sports', 'Comedy', 'Drama', 'Shounen', 'School']
            ],
            [
                'title' => 'Slam Dunk',
                'author' => 'Takehiko Inoue',
                'publisher' => 'Shueisha',
                'synopsis' => 'Hanamichi Sakuragi, a delinquent high school student with no prior basketball experience.',
                'genres' => ['Sports', 'Comedy', 'Drama', 'Shounen', 'School']
            ],
            [
                'title' => 'Hajime no Ippo',
                'author' => 'George Morikawa',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Follows Ippo Makunouchi, a shy and timid high school student who is frequently bullied.',
                'genres' => ['Sports', 'Action', 'Comedy', 'Drama', 'Shounen']
            ],
            
            // Fantasy
            [
                'title' => 'Black Clover',
                'author' => 'Yuuki Tabata',
                'publisher' => 'Shueisha',
                'synopsis' => 'Follows Asta, a boy born without magic in a world where magic is everything. Despite this, he dreams of becoming the Wizard King.',
                'genres' => ['Fantasy', 'Action', 'Comedy', 'Shounen', 'Super Power', 'Demons', 'Magic']
            ],
            [
                'title' => 'Record of Ragnarok',
                'author' => 'Takumi Fukui',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Follows a high-stakes tournament where 13 legendary humans battle 13 powerful gods to decide humanity\'s fate.',
                'genres' => ['Fantasy', 'Action', 'Drama', 'Super Power', 'Supernatural', 'Seinen'],
                'coauthors' => [
                    ['name' => 'Shinya Umemura', 'role' => 'Writer'],
                    ['name' => 'Ajichika', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'Wistoria: Wand and Sword',
                'author' => 'Fujino Omori',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'With a childhood promise to fulfill to his friend, Serfort aims to attain the esteemed position of a Magia Vander.',
                'genres' => ['Shounen', 'Action', 'Comedy', 'Drama', 'School', 'Adventure', 'Fantasy', 'Magic'],
                'coauthors' => [
                    ['name' => 'Toshi Aoi', 'role' => 'Illustrator']
                ]
            ],
            [
                'title' => 'The Seven Deadly Sins',
                'author' => 'Nakaba Suzuki',
                'publisher' => 'Kodansha Comics',
                'synopsis' => 'Follows a group of legendary knights, known as the Seven Deadly Sins, who were accused of treason and disbanded.',
                'genres' => ['Fantasy', 'Action', 'Shounen', 'Super Power', 'Demons', 'Adventure', 'Martial Arts', 'Magic']
            ]
        ];

        $publishers = Publisher::all()->keyBy('name');
        $authors = Author::all()->keyBy('name');
        $genres = DB::table('genres')->pluck('id', 'name')->toArray();

        foreach ($mangaData as $manga) {
            // Remove "Volume X" from title if present
            $title = preg_replace('/\s+Volume\s+\d+.*$/i', '', $manga['title']);
            
            // Check if item already exists
            $existingItem = Item::where('title', $title)->first();
            
            if (!$existingItem) {
                // Create new item
                $item = Item::create([
                    'title' => $title,
                    'description' => $manga['synopsis'],
                    'price' => $faker->randomFloat(2, 400, 1000), // Updated price range
                    'publisher_id' => $publishers[$manga['publisher']]->id ?? null,
                    'publication_date' => $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
                ]);

                // Attach main author
                if (isset($authors[$manga['author']])) {
                    $item->authors()->attach($authors[$manga['author']]->id, [
                        'role' => 'Author',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // If author doesn't exist, create a new one with faker data
                    $newAuthor = Author::create([
                        'name' => $manga['author'],
                        'biography' => 'Creator of ' . $title . '.',
                        'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                        'country' => 'Japan',
                    ]);
                    
                    $item->authors()->attach($newAuthor->id, [
                        'role' => 'Author',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Attach co-authors if any
                if (isset($manga['coauthors'])) {
                    foreach ($manga['coauthors'] as $coauthor) {
                        if (isset($authors[$coauthor['name']])) {
                            $item->authors()->attach($authors[$coauthor['name']]->id, [
                                'role' => $coauthor['role'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        } else {
                            // If co-author doesn't exist, create a new one with faker data
                            $newCoauthor = Author::create([
                                'name' => $coauthor['name'],
                                'biography' => $coauthor['role'] . ' for ' . $title . '.',
                                'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                                'country' => 'Japan',
                            ]);
                            
                            $item->authors()->attach($newCoauthor->id, [
                                'role' => $coauthor['role'],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }

                // Attach genres
                foreach ($manga['genres'] as $genreName) {
                    if (isset($genres[$genreName])) {
                        DB::table('genre_item')->insert([
                            'genre_id' => $genres[$genreName],
                            'item_id' => $item->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                // Create stock
                DB::table('stocks')->insert([
                    'item_id' => $item->id,
                    'quantity' => $faker->numberBetween(1, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Update existing item
                $existingItem->update([
                    'description' => $manga['synopsis'],
                    'title' => $title, // Update title to remove Volume X
                ]);
                
                // Update publisher if it exists
                if (isset($publishers[$manga['publisher']])) {
                    $existingItem->update([
                        'publisher_id' => $publishers[$manga['publisher']]->id
                    ]);
                } else {
                    // If publisher doesn't exist, create a new one
                    $newPublisher = Publisher::create([
                        'name' => $manga['publisher'],
                        'description' => 'Publisher of ' . $title . ' and other manga titles.',
                        'country' => 'Japan',
                        'website' => 'https://www.' . strtolower(str_replace(' ', '', $manga['publisher'])) . '.co.jp',
                    ]);
                    
                    $existingItem->update([
                        'publisher_id' => $newPublisher->id
                    ]);
                }

                // Sync authors
                $authorIds = [];
                if (isset($authors[$manga['author']])) {
                    $authorIds[$authors[$manga['author']]->id] = ['role' => 'Author'];
                } else {
                    // If author doesn't exist, create a new one with faker data
                    $newAuthor = Author::create([
                        'name' => $manga['author'],
                        'biography' => 'Creator of ' . $title . '.',
                        'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                        'country' => 'Japan',
                    ]);
                    
                    $authorIds[$newAuthor->id] = ['role' => 'Author'];
                }
                
                if (isset($manga['coauthors'])) {
                    foreach ($manga['coauthors'] as $coauthor) {
                        if (isset($authors[$coauthor['name']])) {
                            $authorIds[$authors[$coauthor['name']]->id] = ['role' => $coauthor['role']];
                        } else {
                            // If co-author doesn't exist, create a new one with faker data
                            $newCoauthor = Author::create([
                                'name' => $coauthor['name'],
                                'biography' => $coauthor['role'] . ' for ' . $title . '.',
                                'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                                'country' => 'Japan',
                            ]);
                            
                            $authorIds[$newCoauthor->id] = ['role' => $coauthor['role']];
                        }
                    }
                }
                
                $existingItem->authors()->sync($authorIds);

                // Sync genres
                $genreIds = [];
                foreach ($manga['genres'] as $genreName) {
                    if (isset($genres[$genreName])) {
                        $genreIds[] = $genres[$genreName];
                    }
                }
                $existingItem->genres()->sync($genreIds);
            }
        }
        
        // Ensure the specific manga titles have authors and publishers
        $this->ensureAuthorAndPublisher('Berserk', 'Kentaro Miura', 'Hakusensha');
        $this->ensureAuthorAndPublisher('Attack on Titan', 'Hajime Isayama', 'Kodansha Comics');
        $this->ensureAuthorAndPublisher('Vinland Saga', 'Makoto Yukimura', 'Kodansha Comics');
        $this->ensureAuthorAndPublisher('Haikyu!!', 'Haruichi Furudate', 'Shueisha');
        $this->ensureAuthorAndPublisher('Slam Dunk', 'Takehiko Inoue', 'Shueisha');
    }
    
    /**
     * Ensure a manga has the correct author and publisher
     */
    private function ensureAuthorAndPublisher(string $title, string $authorName, string $publisherName): void
    {
        $faker = Faker::create();
        
        $item = Item::where('title', $title)->first();
        if (!$item) {
            return;
        }
        
        // Ensure publisher exists
        $publisher = Publisher::where('name', $publisherName)->first();
        if (!$publisher) {
            $publisher = Publisher::create([
                'name' => $publisherName,
                'description' => 'Publisher of ' . $title . ' and other manga titles.',
                'country' => 'Japan',
                'website' => 'https://www.' . strtolower(str_replace(' ', '', $publisherName)) . '.co.jp',
            ]);
        }
        
        // Update publisher
        $item->publisher_id = $publisher->id;
        $item->save();
        
        // Ensure author exists
        $author = Author::where('name', $authorName)->first();
        if (!$author) {
            $author = Author::create([
                'name' => $authorName,
                'biography' => 'Creator of ' . $title . '.',
                'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                'country' => 'Japan',
            ]);
        }
        
        // Ensure author relationship exists
        if (!$item->authors()->where('authors.id', $author->id)->exists()) {
            $item->authors()->attach($author->id, [
                'role' => 'Author',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}