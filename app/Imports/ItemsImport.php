<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Item;
use App\Models\Publisher;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class ItemsImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            DB::beginTransaction();
            try {
                // Find or create publisher
                $publisher = null;
                if (!empty($row['publisher'])) {
                    $publisher = Publisher::firstOrCreate(
                        ['name' => $row['publisher']],
                        ['description' => 'Imported publisher']
                    );
                }

                // Handle publication date
                $publicationDate = null;
                if (!empty($row['publication_date'])) {
                    // Check if it's a numeric value (Excel date)
                    if (is_numeric($row['publication_date'])) {
                        $publicationDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['publication_date']);
                    } else {
                        // Try to parse as a string date
                        try {
                            $publicationDate = Carbon::parse($row['publication_date']);
                        } catch (\Exception $e) {
                            // If parsing fails, set to null
                            $publicationDate = null;
                        }
                    }
                }

                // Create the item
                $item = Item::create([
                    'title' => $row['title'],
                    'description' => $row['description'] ?? 'No description provided',
                    'price' => $row['price'] ?? 0,
                    'publisher_id' => $publisher ? $publisher->id : null,
                    'publication_date' => $publicationDate,
                ]);

                // Create stock
                Stock::create([
                    'item_id' => $item->id,
                    'quantity' => $row['stock'] ?? 0,
                ]);

                // Handle genres
                if (!empty($row['genres'])) {
                    $genreNames = explode(',', $row['genres']);
                    $genreIds = [];
                    
                    foreach ($genreNames as $genreName) {
                        $genreName = trim($genreName);
                        if (!empty($genreName)) {
                            $genre = Genre::firstOrCreate(
                                ['name' => $genreName],
                                ['description' => 'Imported genre']
                            );
                            $genreIds[] = $genre->id;
                        }
                    }
                    
                    if (!empty($genreIds)) {
                        $item->genres()->attach($genreIds);
                    }
                }

                // Handle authors
                if (!empty($row['authors'])) {
                    $authorNames = explode(',', $row['authors']);
                    
                    foreach ($authorNames as $authorName) {
                        $authorName = trim($authorName);
                        if (!empty($authorName)) {
                            $author = Author::firstOrCreate(
                                ['name' => $authorName],
                                ['biography' => 'Imported author']
                            );
                            
                            $item->authors()->attach($author->id, [
                                'role' => 'Author'
                            ]);
                        }
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
        ];
    }
}