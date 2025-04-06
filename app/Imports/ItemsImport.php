<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Item;
use App\Models\Publisher;
use App\Models\Stock;
use App\Models\ItemImage; // Make sure to include this
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;
use Illuminate\Support\Facades\Log;

class ItemsImport implements ToCollection, WithHeadingRow, WithDrawings
{
    protected $drawings = [];
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 15,
            'headers' => [
                'User -Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'image/webp,image/apng,image/*,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.9',
            ],
        ]);
    }

    public function drawings()
    {
        return $this->drawings;
    }

    public function collection(Collection $rows)
    {
        $drawingMap = $this->mapDrawingsByRow();

        foreach ($rows as $index => $row) {
            $currentRow = $index + 2; // Excel data starts at row 2
            try {
                $this->validateRow($row, $currentRow);

                $publisher = Publisher::firstOrCreate(
                    ['name' => $row['publisher']],
                    ['description' => 'Imported publisher']
                );

                // Handle publication date
                $publicationDate = null;
                if (!empty($row['publication_date'])) {
                    if (is_numeric($row['publication_date'])) {
                        $publicationDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['publication_date']);
                    } else {
                        try {
                            $publicationDate = Carbon::parse($row['publication_date']);
                        } catch (\Exception $e) {
                            $publicationDate = null;
                        }
                    }
                }

                // Create the item
                $item = Item::create([
                    'title' => $row['title'],
                    'description' => $row['description'] ?? 'No description provided',
                    'price' => $row['price'] ?? 0,
                    'publisher_id' => $publisher->id,
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

                // Process embedded drawings
                if (isset($drawingMap[$currentRow])) {
                    foreach ($drawingMap[$currentRow] as $drawing) {
                        $this->processDrawing($drawing, $item->id);
                    }
                }

                // Process image URLs if provided
                if (!empty($row['image_path'])) {
                    $this->processImageUrls($row['image_path'], $item->id);
                }

            } catch (Exception $e) {
                Log::error("Import error on row {$currentRow}: " . $e->getMessage());
                continue;
            }
        }
    }

    protected function mapDrawingsByRow()
    {
        $drawingMap = [];
        foreach ($this->drawings as $drawing) {
            if ($drawing instanceof Drawing && $drawing->getCoordinates()) {
                $coordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::coordinateFromString($drawing->getCoordinates());
                $rowNumber = $coordinate[1];
                $drawingMap[$rowNumber][] = $drawing;
            }
        }
        return $drawingMap;
    }

    protected function validateRow($row, $currentRow)
    {
        if (empty($row['title'])) {
            throw new Exception("Title is required on row {$currentRow}");
        }
        
    }

    protected function processDrawing(Drawing $drawing, $itemId)
    {
        try {
            $extension = $drawing->getExtension() ?: 'jpg';
            $hashName = Str::random(40) . '.' . $extension;
            $storagePath = 'public/images/' . $hashName;

            Storage::put($storagePath, file_get_contents($drawing->getPath()));

            ItemImage::create([
                'item_id'    => $itemId,
                'image_path' => $storagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Exception $e) {
            Log::error("Failed to process drawing for item {$itemId}: " . $e->getMessage());
        }
    }

    protected function processImageUrls($imagePaths, $itemId)
    {
        $urls = str_getcsv($imagePaths);

        foreach ($urls as $url) {
            $url = trim($url);

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                continue; // Skip invalid URLs
            }

            try {
                $response = $this->client->get($url);

                if ($response->getStatusCode() === 200) {
                    $imageContent = $response->getBody()->getContents();

                    $contentType = $response->getHeaderLine('Content-Type');
                    $extension = $this->getExtensionFromContentType($contentType) ?: 'jpg';

                    $hashName = Str::random(40) . '.' . $extension;
                    $storagePath = 'public/images/' . $hashName;

                    Storage::put($storagePath, $imageContent);

                    ItemImage::create([
                        'item_id'    => $itemId,
                        'image_path' => $storagePath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } catch (RequestException $e) {
                Log::error("Failed to download image from {$url}: " . $e->getMessage());
            } catch (Exception $e) {
                Log::error("Error processing image URL {$url}: " . $e->getMessage());
            }
        }
    }

    protected function getExtensionFromContentType($contentType)
    {
        $mappings = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
        ];

        return $mappings[$contentType] ?? null;
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