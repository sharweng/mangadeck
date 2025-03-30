<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Item::with(['genres', 'authors', 'publisher', 'stock', 'reviews'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'Authors',
            'Genres',
            'Publisher',
            'Price',
            'Stock',
            'Average Rating',
            'Total Reviews',
            'Publication Date',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * @param Item $item
     * @return array
     */
    public function map($item): array
    {
        // Calculate average rating
        $avgRating = $item->reviews->count() > 0 
            ? number_format($item->reviews->avg('rating'), 1) 
            : 'N/A';
            
        return [
            $item->id,
            $item->title,
            $item->description,
            $item->authors->pluck('name')->implode(', '),
            $item->genres->pluck('name')->implode(', '),
            $item->publisher ? $item->publisher->name : 'N/A',
            number_format($item->price, 2),
            $item->stock ? $item->stock->quantity : 0,
            $avgRating,
            $item->reviews->count(),
            $item->publication_date ? $item->publication_date->format('Y-m-d') : 'N/A',
            $item->created_at->format('Y-m-d'),
            $item->updated_at->format('Y-m-d'),
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