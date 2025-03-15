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
                'name' => 'Shonen',
                'description' => 'Manga aimed at teenage boys, typically featuring action, adventure, and coming-of-age themes.',
            ],
            [
                'name' => 'Shojo',
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
        ];

        foreach ($genres as $genre) {
            $genre['created_at'] = now();
            $genre['updated_at'] = now();
            DB::table('genres')->insert($genre);
        }
    }
}