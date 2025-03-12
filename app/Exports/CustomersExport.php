<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::with('user')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email',
            'Address',
            'Phone',
            'Status',
            'Registration Date',
            'Total Orders',
            'Total Spent',
        ];
    }

    /**
     * @param Customer $customer
     * @return array
     */
    public function map($customer): array
    {
        $totalSpent = $customer->orders->sum(function ($order) {
            return $order->total;
        });

        return [
            $customer->id,
            $customer->full_name,
            $customer->user->email,
            $customer->addressline,
            $customer->phone,
            $customer->user->status,
            $customer->created_at->format('Y-m-d'),
            $customer->orders->count(),
            number_format($totalSpent, 2),
        ];
    }
}

