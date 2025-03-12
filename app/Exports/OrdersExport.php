<?php

namespace App\Exports;

use App\Models\OrderInfo;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromQuery, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = OrderInfo::with(['customer', 'status', 'orderLines']);
        
        if ($this->startDate) {
            $query->where('date_placed', '>=', $this->startDate);
        }
        
        if ($this->endDate) {
            $query->where('date_placed', '<=', $this->endDate);
        }
        
        return $query;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Order ID',
            'Customer',
            'Date Placed',
            'Date Shipped',
            'Shipping Cost',
            'Status',
            'Items Count',
            'Total',
            'Notes',
        ];
    }

    /**
     * @param OrderInfo $order
     * @return array
     */
    public function map($order): array
    {
        return [
            $order->id,
            $order->customer->full_name,
            $order->date_placed->format('Y-m-d'),
            $order->date_shipped ? $order->date_shipped->format('Y-m-d') : 'N/A',
            number_format($order->shipping, 2),
            $order->status->name,
            $order->orderLines->sum('quantity'),
            number_format($order->total, 2),
            $order->notes ?? 'N/A',
        ];
    }
}

