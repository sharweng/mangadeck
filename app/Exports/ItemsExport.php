<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Item::with(['genre', 'stock', 'reviews'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Author',
            'Genre',
            'Price',
            'Stock',
            'Average Rating',
            'Total Reviews',
            'Publisher',
            'Publication Date',
            'ISBN',
            'Pages',
        ];
    }

    /**
     * @param Item $item
     * @return array
     */
    public function map($item): array
    {
        return [
            $item->id,
            $item->title,
            $item->author ?? 'N/A',
            $item->genre->name,
            number_format($item->price, 2),
            $item->stock ? $item->stock->quantity : 0,
            number_format($item->average_rating, 1),
            $item->reviews->count(),
            $item->publisher ?? 'N/A',
            $item->publication_date ? $item->publication_date->format('Y-m-d') : 'N/A',
            $item->isbn ?? 'N/A',
            $item->pages ?? 'N/A',
        ];
    }
}

