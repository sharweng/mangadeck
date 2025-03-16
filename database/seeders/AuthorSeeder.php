<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Author;

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

        $authors = [
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
                'name' => 'Kohei Horikoshi',
                'biography' => 'Creator of My Hero Academia, a superhero manga set in a world where most people have superpowers.',
                'birth_date' => '1986-11-20',
                'country' => 'Japan',
            ],
            [
                'name' => 'Koyoharu Gotouge',
                'biography' => 'Creator of Demon Slayer, a dark fantasy manga about a young boy who becomes a demon slayer.',
                'birth_date' => '1989-05-05',
                'country' => 'Japan',
            ],
            [
                'name' => 'Gege Akutami',
                'biography' => 'Creator of Jujutsu Kaisen, a supernatural horror manga about a high school student who joins a secret organization of sorcerers.',
                'birth_date' => '1992-02-28',
                'country' => 'Japan',
            ],
            [
                'name' => 'Sui Ishida',
                'biography' => 'Creator of Tokyo Ghoul, a dark fantasy manga about a college student who becomes half-ghoul after a transplant.',
                'birth_date' => '1986-12-28',
                'country' => 'Japan',
            ],
            [
                'name' => 'Tsugumi Ohba',
                'biography' => 'Writer of Death Note, a psychological thriller manga about a high school student who discovers a supernatural notebook.',
                'birth_date' => '1969-02-17',
                'country' => 'Japan',
            ],
            [
                'name' => 'Takeshi Obata',
                'biography' => 'Illustrator of Death Note and Bakuman, known for his detailed art style.',
                'birth_date' => '1969-02-11',
                'country' => 'Japan',
            ],
            [
                'name' => 'Hiromu Arakawa',
                'biography' => 'Creator of Fullmetal Alchemist, a fantasy adventure manga about two brothers seeking the philosopher\'s stone.',
                'birth_date' => '1973-05-08',
                'country' => 'Japan',
            ],
            [
                'name' => 'Yoshihiro Togashi',
                'biography' => 'Creator of Hunter x Hunter and Yu Yu Hakusho, known for complex storytelling.',
                'birth_date' => '1966-04-27',
                'country' => 'Japan',
            ],
            [
                'name' => 'Naoko Takeuchi',
                'biography' => 'Creator of Sailor Moon, a magical girl manga that became a global phenomenon.',
                'birth_date' => '1967-03-15',
                'country' => 'Japan',
            ],
            [
                'name' => 'Natsuki Takaya',
                'biography' => 'Creator of Fruits Basket, a romantic comedy manga with supernatural elements.',
                'birth_date' => '1973-07-07',
                'country' => 'Japan',
            ],
            [
                'name' => 'Ai Yazawa',
                'biography' => 'Creator of Nana, a josei manga about two women with the same name pursuing their dreams.',
                'birth_date' => '1967-03-07',
                'country' => 'Japan',
            ],
            [
                'name' => 'Bisco Hatori',
                'biography' => 'Creator of Ouran High School Host Club, a romantic comedy manga set in a high school host club.',
                'birth_date' => '1975-08-30',
                'country' => 'Japan',
            ],
            [
                'name' => 'Kentaro Miura',
                'biography' => 'Creator of Berserk, a dark fantasy manga known for its intricate artwork and mature themes.',
                'birth_date' => '1966-07-11',
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
            [
                'name' => 'Naoki Urasawa',
                'biography' => 'Creator of Monster and 20th Century Boys, known for his psychological thrillers.',
                'birth_date' => '1960-01-02',
                'country' => 'Japan',
            ],
            [
                'name' => 'Tatsuya Endo',
                'biography' => 'Creator of Spy x Family, a comedy-action manga about a spy who builds a fake family.',
                'birth_date' => '1980-07-23',
                'country' => 'Japan',
            ],
            [
                'name' => 'Tatsuki Fujimoto',
                'biography' => 'Creator of Chainsaw Man, a dark fantasy manga about a young man who can transform into a chainsaw devil.',
                'birth_date' => '1992-10-10',
                'country' => 'Japan',
            ],
            [
                'name' => 'Haruichi Furudate',
                'biography' => 'Creator of Haikyu!!, a sports manga about a high school volleyball team.',
                'birth_date' => '1983-03-07',
                'country' => 'Japan',
            ],
            [
                'name' => 'Naoshi Arakawa',
                'biography' => 'Creator of Your Lie in April, a drama manga about a pianist who loses his ability to hear the piano.',
                'birth_date' => '1984-12-05',
                'country' => 'Japan',
            ],
            [
                'name' => 'Yoshitoki Oima',
                'biography' => 'Creator of A Silent Voice, a drama manga about a boy who bullies a deaf girl.',
                'birth_date' => '1989-03-15',
                'country' => 'Japan',
            ],
            [
                'name' => 'Kaiu Shirai',
                'biography' => 'Writer of The Promised Neverland, a thriller manga about orphans who discover the dark truth about their orphanage.',
                'birth_date' => '1988-01-01',
                'country' => 'Japan',
            ],
            [
                'name' => 'Posuka Demizu',
                'biography' => 'Illustrator of The Promised Neverland, known for her detailed and atmospheric art.',
                'birth_date' => '1988-12-28',
                'country' => 'Japan',
            ],
            [
                'name' => 'Akihito Tsukushi',
                'biography' => 'Creator of Made in Abyss, a fantasy adventure manga about a girl who descends into a mysterious abyss.',
                'birth_date' => '1978-03-04',
                'country' => 'Japan',
            ],
            [
                'name' => 'Tappei Nagatsuki',
                'biography' => 'Writer of Re:Zero, an isekai light novel and manga series about a young man transported to another world.',
                'birth_date' => '1987-03-11',
                'country' => 'Japan',
            ],
            [
                'name' => 'Reki Kawahara',
                'biography' => 'Creator of Sword Art Online, a science fiction light novel and manga series about virtual reality MMORPGs.',
                'birth_date' => '1974-08-17',
                'country' => 'Japan',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}

