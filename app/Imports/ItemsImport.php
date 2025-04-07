<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Item;
use App\Models\Publisher;
use App\Models\Stock;
use App\Models\ItemImage;
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
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'image/webp,image/apng,image/*,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.9',
            ],
        ]);
    }

    public function drawings()
    {
        return $this->drawings;
    }

    /**
     * Store drawings from the spreadsheet
     */
    public function registerDrawings($drawings)
    {
        $this->drawings = $drawings;
    }

    public function collection(Collection $rows)
    {
        $drawingMap = $this->mapDrawingsByRow();

        foreach ($rows as $index => $row) {
            $currentRow = $index + 2; // Excel data starts at row 2
            try {
                $this->validateRow($row, $currentRow);

                // Create or find publisher
                $publisher = Publisher::firstOrCreate(
                    ['name' => $row['publisher'] ?? 'Unknown'],
                    ['description' => 'Imported publisher']
                );

                // Handle publication date
                $publicationDate = $this->parsePublicationDate($row['publication_date'] ?? null);

                // Create the item
                $item = Item::create([
                    'title' => $row['title'],
                    'description' => $this->cleanDescription($row['description'] ?? 'No description provided'),
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
                $this->processGenres($row['genres'] ?? '', $item);

                // Handle authors
                $this->processAuthors($row['authors'] ?? '', $item);

                // Process embedded drawings
                if (isset($drawingMap[$currentRow])) {
                    foreach ($drawingMap[$currentRow] as $drawing) {
                        $this->processDrawing($drawing, $item->id);
                    }
                }

                // Process image URLs - check both image_path and image_url columns
                if (!empty($row['image_path'])) {
                    $this->processImageUrls($row['image_path'], $item->id);
                }
                
                // Also check for image_url column as a fallback
                if (empty($row['image_path']) && !empty($row['image_url'])) {
                    $this->processImageUrls($row['image_url'], $item->id);
                }

            } catch (Exception $e) {
                Log::error("Import error on row {$currentRow}: " . $e->getMessage());
                continue;
            }
        }
    }

    protected function cleanDescription($description)
    {
        // Remove Excel line breaks if needed
        return str_replace(["\r", "\n"], ' ', $description);
    }

    protected function parsePublicationDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            if (is_numeric($date)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
            }
            return Carbon::parse($date);
        } catch (\Exception $e) {
            Log::warning("Failed to parse publication date: " . $e->getMessage());
            return null;
        }
    }

    protected function processGenres($genresString, $item)
    {
        if (empty($genresString)) {
            return;
        }

        $genreNames = array_map('trim', explode(',', $genresString));
        $genreIds = [];
        
        foreach ($genreNames as $genreName) {
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

    protected function processAuthors($authorsString, $item)
    {
        if (empty($authorsString)) {
            return;
        }

        $authorNames = array_map('trim', explode(',', $authorsString));
        
        foreach ($authorNames as $authorName) {
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
            $storagePath = 'public/items/' . $hashName;
            $dbPath = 'items/' . $hashName;

            // Store the image
            Storage::put($storagePath, file_get_contents($drawing->getPath()));

            // Check if this is the first image for this item
            $isPrimary = !ItemImage::where('item_id', $itemId)->exists();

            ItemImage::create([
                'item_id'    => $itemId,
                'image_path' => $dbPath,
                'is_primary' => $isPrimary,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info("Successfully processed drawing for item {$itemId}: {$dbPath}");
        } catch (Exception $e) {
            Log::error("Failed to process drawing for item {$itemId}: " . $e->getMessage());
        }
    }

    protected function processImageUrls($imagePaths, $itemId)
    {
        try {
            // Clean the input - remove quotes and trim
            $imagePaths = trim(str_replace(['"', "'"], '', $imagePaths));
            
            // Handle both single URL and comma-separated URLs
            $urls = is_array($imagePaths) ? $imagePaths : explode(',', $imagePaths);
            
            foreach ($urls as $url) {
                $url = trim($url);
                
                if (empty($url)) {
                    continue;
                }

                // Check if it's a local file path rather than a URL
                if (!filter_var($url, FILTER_VALIDATE_URL)) {
                    // If it's a local path, handle it differently
                    if (file_exists($url) || Storage::exists($url)) {
                        $this->processLocalImage($url, $itemId);
                        continue;
                    }
                    
                    Log::warning("Invalid URL or file not found for item {$itemId}: {$url}");
                    continue;
                }

                try {
                    $response = $this->client->get($url, ['stream' => true]);
                    
                    if ($response->getStatusCode() === 200) {
                        $imageContent = $response->getBody()->getContents();
                        
                        // Get extension from content type or URL
                        $contentType = $response->getHeaderLine('Content-Type');
                        $extension = $this->getExtensionFromContentType($contentType) ?: 
                                      pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                        
                        $hashName = Str::random(40) . '.' . strtolower($extension);
                        $storagePath = 'public/items/' . $hashName;
                        $dbPath = 'items/' . $hashName;

                        // Save to storage
                        if (Storage::put($storagePath, $imageContent)) {
                            // Check if this is the first image for this item
                            $isPrimary = !ItemImage::where('item_id', $itemId)->exists();

                            ItemImage::create([
                                'item_id'    => $itemId,
                                'image_path' => $dbPath,
                                'is_primary' => $isPrimary,
                            ]);
                            Log::info("Successfully downloaded and stored image for item {$itemId}: {$url}");
                        } else {
                            Log::error("Failed to store image for item {$itemId}: {$url}");
                        }
                    }
                } catch (RequestException $e) {
                    Log::error("Failed to download image for item {$itemId} from {$url}: " . $e->getMessage());
                }
            }
        } catch (Exception $e) {
            Log::error("Error processing image URLs for item {$itemId}: " . $e->getMessage());
        }
    }
    
    /**
     * Process a local image file
     */
    protected function processLocalImage($filePath, $itemId)
    {
        try {
            if (file_exists($filePath)) {
                $imageContent = file_get_contents($filePath);
            } elseif (Storage::exists($filePath)) {
                $imageContent = Storage::get($filePath);
            } else {
                Log::error("Local file not found for item {$itemId}: {$filePath}");
                return;
            }
            
            $extension = pathinfo($filePath, PATHINFO_EXTENSION) ?: 'jpg';
            $hashName = Str::random(40) . '.' . strtolower($extension);
            $storagePath = 'public/items/' . $hashName;
            $dbPath = 'items/' . $hashName;
            
            if (Storage::put($storagePath, $imageContent)) {
                // Check if this is the first image for this item
                $isPrimary = !ItemImage::where('item_id', $itemId)->exists();
                
                ItemImage::create([
                    'item_id'    => $itemId,
                    'image_path' => $dbPath,
                    'is_primary' => $isPrimary,
                ]);
                Log::info("Successfully processed local image for item {$itemId}: {$filePath}");
            } else {
                Log::error("Failed to store local image for item {$itemId}: {$filePath}");
            }
        } catch (Exception $e) {
            Log::error("Error processing local image for item {$itemId}: " . $e->getMessage());
        }
    }

    protected function getExtensionFromContentType($contentType)
    {
        $mappings = [
            'image/jpeg' => 'jpg',
            'image/jpg'  => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
        ];

        foreach ($mappings as $type => $ext) {
            if (str_contains($contentType, $type)) {
                return $ext;
            }
        }

        return null;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
        ];
    }
}