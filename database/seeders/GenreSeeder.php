<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if genres already exist
        if (DB::table('genres')->count() > 0) {
            return;
        }

        $genres = [
            [
                'name' => 'Shounen',
                'description' => 'Manga aimed at teenage boys, typically featuring action, adventure, and coming-of-age themes.',
            ],
            [
                'name' => 'Shoujo',
                'description' => 'Manga aimed at teenage girls, often focusing on romance, relationships, and personal growth.',
            ],
            [
                'name' => 'Seinen',
                'description' => 'Manga aimed at adult men, featuring more mature themes, complex characters, and realistic scenarios.',
            ],
            [
                'name' => 'Josei',
                'description' => 'Manga aimed at adult women, exploring mature relationships, career challenges, and daily life.',
            ],
            [
                'name' => 'Isekai',
                'description' => 'Stories about characters transported to or reborn in another world, often with fantasy elements.',
            ],
            [
                'name' => 'Mecha',
                'description' => 'Stories featuring robots, mechanical technology, and often exploring the relationship between humans and machines.',
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Stories with magical or supernatural elements, often set in fictional worlds with unique rules and systems.',
            ],
            [
                'name' => 'Horror',
                'description' => 'Stories designed to frighten or scare readers, featuring supernatural threats, psychological terror, or gore.',
            ],
            [
                'name' => 'Romance',
                'description' => 'Stories focused on romantic relationships and emotional connections between characters.',
            ],
            [
                'name' => 'Sports',
                'description' => 'Stories centered around athletics and competition, often featuring character growth through sports.',
            ],
            [
                'name' => 'Slice of Life',
                'description' => 'Stories depicting everyday experiences and focusing on the mundane aspects of characters\' lives.',
            ],
            [
                'name' => 'Mystery',
                'description' => 'Stories involving the solution of a mystery, often featuring detectives, crimes, or puzzles.',
            ],
            [
                'name' => 'Action',
                'description' => 'Stories with emphasis on physical conflict, battles, and high-energy sequences.',
            ],
            [
                'name' => 'Adventure',
                'description' => 'Stories focused on journeys, exploration, and discovery of new places or experiences.',
            ],
            [
                'name' => 'Comedy',
                'description' => 'Stories designed to be humorous and make readers laugh.',
            ],
            [
                'name' => 'Drama',
                'description' => 'Stories with emotional intensity and character development through conflict.',
            ],
            [
                'name' => 'Supernatural',
                'description' => 'Stories featuring elements beyond scientific understanding, like ghosts, spirits, or paranormal abilities.',
            ],
            [
                'name' => 'Psychological',
                'description' => 'Stories that explore the mental states and processes of characters.',
            ],
            [
                'name' => 'Dark Fantasy',
                'description' => 'Fantasy stories with darker, more mature themes and often grim or disturbing elements.',
            ],
            [
                'name' => 'Sci-Fi',
                'description' => 'Stories based on scientific concepts and technological advancement, often set in the future.',
            ],
            [
                'name' => 'Military',
                'description' => 'Stories focused on armed forces, warfare, and military life.',
            ],
            [
                'name' => 'Demons',
                'description' => 'Stories featuring demonic entities or characters with demonic powers.',
            ],
            [
                'name' => 'Magic',
                'description' => 'Stories where magical powers and spells play a significant role.',
            ],
            [
                'name' => 'School',
                'description' => 'Stories set primarily in educational institutions.',
            ],
            [
                'name' => 'Super Power',
                'description' => 'Stories featuring characters with extraordinary abilities beyond normal human capabilities.',
            ],
            [
                'name' => 'Vampire',
                'description' => 'Stories featuring vampires as main characters or central to the plot.',
            ],
            [
                'name' => 'Martial Arts',
                'description' => 'Stories focused on various forms of combat and fighting techniques.',
            ],
            [
                'name' => 'Music',
                'description' => 'Stories where music plays a central role in the plot or character development.',
            ],
            [
                'name' => 'Boys Love',
                'description' => 'Stories focusing on romantic or sexual relationships between male characters.',
            ],
            [
                'name' => 'Ecchi',
                'description' => 'Stories with suggestive or mildly sexual content, but not explicit.',
            ],
            [
                'name' => 'Space',
                'description' => 'Stories set in outer space or involving space travel.',
            ],
            [
                'name' => 'Iyashikei',
                'description' => 'Healing or soothing stories designed to provide a sense of comfort and relaxation.',
            ],
            [
                'name' => 'Parody',
                'description' => 'Stories that imitate and satirize other works or genres.',
            ],
        ];

        foreach ($genres as $genre) {
            $genre['created_at'] = now();
            $genre['updated_at'] = now();
            DB::table('genres')->insert($genre);
        }
    }
}