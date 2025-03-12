<?php

namespace App\Exports;

use App\Models\OrderInfo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $year;

    public function __construct($year = null)
    {
        $this->year = $year ?? date('Y');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $monthlySales = OrderInfo::select(
                DB::raw('MONTH(date_placed) as month'),
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM((SELECT SUM(orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id)) as items_sold'),
                DB::raw('SUM((SELECT SUM(orderlines.price * orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id)) as subtotal'),
                DB::raw('SUM(shipping) as shipping_total'),
                DB::raw('SUM((SELECT SUM(orderlines.price * orderlines.quantity) FROM orderlines WHERE orderlines.orderinfo_id = orderinfos.id) + shipping) as total')
            )
            ->whereYear('date_placed', $this->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Fill in missing months with zeros
        $allMonths = collect(range(1, 12))->map(function ($month) use ($monthlySales) {
            $existingMonth = $monthlySales->firstWhere('month', $month);
            
            if ($existingMonth) {
                return $existingMonth;
            }
            
            return (object) [
                'month' => $month,
                'order_count' => 0,
                'items_sold' => 0,
                'subtotal' => 0,
                'shipping_total' => 0,
                'total' => 0,
            ];
        })->sortBy('month');
        
        return $allMonths;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Year',
            'Month',
            'Orders',
            'Items Sold',
            'Subtotal',
            'Shipping',
            'Total Revenue',
        ];
    }

    /**
     * @param object $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $this->year,
            Carbon::create($this->year, $row->month, 1)->format('F'),
            $row->order_count,
            $row->items_sold,
            number_format($row->subtotal, 2),
            number_format($row->shipping_total, 2),
            number_format($row->total, 2),
        ];
    }
}

