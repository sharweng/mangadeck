<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\OrdersExport;
use App\Exports\ItemsExport;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display the report options.
     */
    public function index()
    {
        $this->authorize('viewReports');
        
        return view('admin.reports.index');
    }

    /**
     * Export customers report.
     */
    public function exportCustomers()
    {
        $this->authorize('viewReports');
        
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

    /**
     * Export orders report.
     */
    public function exportOrders(Request $request)
    {
        $this->authorize('viewReports');
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        return Excel::download(new OrdersExport($startDate, $endDate), 'orders.xlsx');
    }

    /**
     * Export items report.
     */
    public function exportItems()
    {
        $this->authorize('viewReports');
        
        return Excel::download(new ItemsExport, 'items.xlsx');
    }

    /**
     * Export sales report.
     */
    public function exportSales(Request $request)
    {
        $this->authorize('viewReports');
        
        $year = $request->input('year', date('Y'));
        
        return Excel::download(new SalesExport($year), 'sales.xlsx');
    }
}

