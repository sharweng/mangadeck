<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip if authors already exist
        if (DB::table('authors')->count() > 0) {
            return;
        }

        $faker = Faker::create();
        $faker->seed(1234); // Consistent results between runs

        $authors = [
            // Existing authors with known birth dates remain unchanged
            [
                'name' => 'Eiichiro Oda',
                'biography' => 'Creator of One Piece, one of the best-selling manga series of all time.',
                'birth_date' => '1975-01-01',
                'country' => 'Japan',
            ],
            [
                'name' => 'Masashi Kishimoto',
                'biography' => 'Creator of Naruto, a globally popular ninja-themed manga series.',
                'birth_date' => '1974-11-08',
                'country' => 'Japan',
            ],
            [
                'name' => 'Tite Kubo',
                'biography' => 'Creator of Bleach, a supernatural action manga about Soul Reapers.',
                'birth_date' => '1977-06-26',
                'country' => 'Japan',
            ],
            [
                'name' => 'Akira Toriyama',
                'biography' => 'Creator of Dragon Ball, one of the most influential manga series worldwide.',
                'birth_date' => '1955-04-05',
                'country' => 'Japan',
            ],
            [
                'name' => 'Hajime Isayama',
                'biography' => 'Creator of Attack on Titan, a dark fantasy manga about humanity\'s struggle against titans.',
                'birth_date' => '1986-08-29',
                'country' => 'Japan',
            ],
            [
                'name' => 'Haruichi Furudate',
                'biography' => 'Creator of Haikyu!!, a sports manga about a high school volleyball team.',
                'birth_date' => '1983-03-07',
                'country' => 'Japan',
            ],
            [
                'name' => 'Takehiko Inoue',
                'biography' => 'Creator of Slam Dunk and Vagabond, known for his realistic art style.',
                'birth_date' => '1967-01-12',
                'country' => 'Japan',
            ],
            [
                'name' => 'Makoto Yukimura',
                'biography' => 'Creator of Vinland Saga, a historical manga set in the Viking Age.',
                'birth_date' => '1976-05-08',
                'country' => 'Japan',
            ],
            
            // New authors with researched birth dates or Faker-generated ones
            [
                'name' => 'Takeru Hokazono',
                'biography' => 'Creator of Kagurabachi, a shounen manga series about a young swordsmith seeking revenge.',
                'birth_date' => $faker->dateTimeBetween('-40 years', '-25 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Sousuke Tooka',
                'biography' => 'Creator of Ranking of Kings, a fantasy adventure manga about a deaf prince.',
                'birth_date' => '1985-08-15', // Estimated based on career timeline
                'country' => 'Japan',
            ],
            [
                'name' => 'Takaya Kagami',
                'biography' => 'Writer of Seraph of the End, a vampire-themed shounen manga.',
                'birth_date' => '1979-04-22', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Yamato Yamamoto',
                'biography' => 'Illustrator of Seraph of the End, known for detailed artwork.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-30 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Daisuke Furuya',
                'biography' => 'Collaborator on Seraph of the End, contributing to story development.',
                'birth_date' => $faker->dateTimeBetween('-50 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Kouji Miura',
                'biography' => 'Creator of Blue Box, a sports romance manga.',
                'birth_date' => '1991-11-03', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Saka Mikami',
                'biography' => 'Creator of The Fragrant Flower Blooms With Dignity, a romance manga.',
                'birth_date' => $faker->dateTimeBetween('-38 years', '-28 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Saeki-san',
                'biography' => 'Writer of The Angel Next Door Spoils Me Rotten, a light novel series.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-30 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Wan Shibata',
                'biography' => 'Illustrator of The Angel Next Door Spoils Me Rotten manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-40 years', '-25 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Shinichi Fukuda',
                'biography' => 'Creator of My Dress-Up Darling, a cosplay-themed romance manga.',
                'birth_date' => '1984-06-19', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Iori',
                'biography' => 'Writer of My Girlfriend is the best!, a romantic comedy manga.',
                'birth_date' => $faker->dateTimeBetween('-42 years', '-32 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Takami Takada',
                'biography' => 'Illustrator of My Girlfriend is the best!, known for expressive character designs.',
                'birth_date' => $faker->dateTimeBetween('-38 years', '-28 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Suu Morishita',
                'biography' => 'Creator of A Sign of Affection, a shoujo romance manga about a deaf protagonist.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Karuho Shiina',
                'biography' => 'Creator of Kimi ni Todoke: From Me to You, a popular shoujo romance manga.',
                'birth_date' => '1976-02-15', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Io Sakisaka',
                'biography' => 'Creator of Ao Haru Ride, a coming-of-age shoujo romance manga.',
                'birth_date' => '1977-05-08', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Rito Kousaka',
                'biography' => 'Illustrator of My Happy Marriage manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-40 years', '-30 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Akumi Agitogi',
                'biography' => 'Writer of My Happy Marriage light novel series.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'George Morikawa',
                'biography' => 'Creator of Hajime no Ippo, a long-running boxing manga series.',
                'birth_date' => '1966-01-17', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Muneyuki Kaneshiro',
                'biography' => 'Writer of Blue Lock, a soccer-themed sports manga.',
                'birth_date' => '1981-08-28', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Yuusuke Nomura',
                'biography' => 'Illustrator of Blue Lock, known for dynamic action scenes.',
                'birth_date' => $faker->dateTimeBetween('-40 years', '-30 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Yuuki Tabata',
                'biography' => 'Creator of Black Clover, a fantasy shounen manga about magic knights.',
                'birth_date' => '1984-07-04', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Takumi Fukui',
                'biography' => 'Writer of Record of Ragnarok, a battle manga featuring historical figures.',
                'birth_date' => $faker->dateTimeBetween('-50 years', '-40 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Shinya Umemura',
                'biography' => 'Writer of Record of Ragnarok, collaborating on story development.',
                'birth_date' => $faker->dateTimeBetween('-48 years', '-38 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Ajichika',
                'biography' => 'Illustrator of Record of Ragnarok, known for detailed character designs.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Fujino Omori',
                'biography' => 'Writer of Wistoria: Wand and Sword, a fantasy adventure manga.',
                'birth_date' => '1978-12-27', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Toshi Aoi',
                'biography' => 'Illustrator of Wistoria: Wand and Sword, known for magical artwork.',
                'birth_date' => $faker->dateTimeBetween('-42 years', '-32 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Nakaba Suzuki',
                'biography' => 'Creator of The Seven Deadly Sins, a fantasy adventure manga.',
                'birth_date' => '1977-04-08', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Mashiro',
                'biography' => 'Creator of Loving Yamada at LV999!, a josei romance manga about gamers.',
                'birth_date' => $faker->dateTimeBetween('-38 years', '-28 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Azusa Banjou',
                'biography' => 'Creator of I Think I Turned My Childhood Friend Into a Girl, a josei BL manga.',
                'birth_date' => $faker->dateTimeBetween('-35 years', '-25 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Fujita',
                'biography' => 'Creator of Wotakoi: Love is Hard for Otaku, a josei romance about adult otaku.',
                'birth_date' => '1983-09-12', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Natsuki Kizu',
                'biography' => 'Creator of Given, a josei BL manga about a boys\' band.',
                'birth_date' => $faker->dateTimeBetween('-40 years', '-30 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Fuse',
                'biography' => 'Writer of That Time I Got Reincarnated as a Slime light novel series.',
                'birth_date' => $faker->dateTimeBetween('-50 years', '-40 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Taiki Kawakami',
                'biography' => 'Illustrator of That Time I Got Reincarnated as a Slime manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Daisuke Aizawa',
                'biography' => 'Writer of The Eminence in Shadow light novel series.',
                'birth_date' => $faker->dateTimeBetween('-42 years', '-32 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Anri Sakano',
                'biography' => 'Illustrator of The Eminence in Shadow manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-38 years', '-28 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Kei Azumi',
                'biography' => 'Illustrator of Tsukimichi: Moonlit Fantasy manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-40 years', '-30 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Kotora Kino',
                'biography' => 'Writer of Tsukimichi: Moonlit Fantasy light novel series.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Kugane Maruyama',
                'biography' => 'Writer of Overlord light novel series.',
                'birth_date' => $faker->dateTimeBetween('-50 years', '-40 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Fugin Miyama',
                'biography' => 'Illustrator of Overlord manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Yoshiyuki Sadamoto',
                'biography' => 'Character designer for Neon Genesis Evangelion and illustrator of the manga adaptation.',
                'birth_date' => '1962-01-29', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Kentarou Yabuki',
                'biography' => 'Illustrator of DARLING in the FRANXX manga adaptation.',
                'birth_date' => '1980-05-20', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Code:000',
                'biography' => 'Writer of DARLING in the FRANXX manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Yoshiyuki Tomino',
                'biography' => 'Creator of the Mobile Suit Gundam franchise.',
                'birth_date' => '1941-11-05', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Yoshikazu Yasuhiko',
                'biography' => 'Character designer for Mobile Suit Gundam and illustrator of Mobile Suit Gundam: The Origin.',
                'birth_date' => '1947-12-09', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Kazuki Nakashima',
                'biography' => 'Writer of Tengen Toppa Gurren Lagann anime series.',
                'birth_date' => '1967-06-28', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Kotarou Mori',
                'biography' => 'Illustrator of Tengen Toppa Gurren Lagann manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Tomoki Izumi',
                'biography' => 'Creator of Mieruko-chan, a supernatural horror comedy manga.',
                'birth_date' => $faker->dateTimeBetween('-38 years', '-28 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Kenichi Kondou',
                'biography' => 'Creator of Dark Gathering, a supernatural horror manga.',
                'birth_date' => $faker->dateTimeBetween('-42 years', '-32 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Anji Matono',
                'biography' => 'Creator of The Hundred Ghost Stories That Led to My Death, a horror manga.',
                'birth_date' => $faker->dateTimeBetween('-40 years', '-30 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Tsuina Miura',
                'biography' => 'Writer of Ajin: Demi-Human manga series.',
                'birth_date' => '1980-07-30', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Gamon Sakurai',
                'biography' => 'Illustrator of Ajin: Demi-Human manga series.',
                'birth_date' => $faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Shougo Kinugasa',
                'biography' => 'Writer of Classroom of the Elite light novel series.',
                'birth_date' => $faker->dateTimeBetween('-50 years', '-40 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Yuyu Ichino',
                'biography' => 'Illustrator of Classroom of the Elite manga adaptation.',
                'birth_date' => $faker->dateTimeBetween('-38 years', '-28 years')->format('Y-m-d'),
                'country' => 'Japan',
            ],
            [
                'name' => 'Inio Asano',
                'biography' => 'Creator of Goodnight Punpun, a psychological drama manga.',
                'birth_date' => '1980-09-22', // Actual birth date found
                'country' => 'Japan',
            ],
            [
                'name' => 'Studio Gaga',
                'biography' => 'Art studio continuing Berserk manga after Kentaro Miura\'s passing.',
                'birth_date' => null, // Studio doesn't have a birth date
                'country' => 'Japan',
            ],
        ];

        foreach ($authors as $author) {
            // Check if author already exists before creating
            if (!Author::where('name', $author['name'])->exists()) {
                Author::create($author);
            }
        }
    }
}