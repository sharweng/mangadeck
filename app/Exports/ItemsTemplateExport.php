<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsTemplateExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            ['Example Manga', 'Description here', '19.99', '10', 'Shonen,Action', 'Author Name', 'Publisher Name', date('Y-m-d'), 'http://example.com/image.jpg'] // Added image URL
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'title', 
            'description', 
            'price', 
            'stock', 
            'genres', 
            'authors', 
            'publisher', 
            'publication_date', 
            'image_path' // Added image path heading
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold
            1 => ['font' => ['bold' => true]],
        ];
    }
}