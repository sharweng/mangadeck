@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Reports</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Customer Reports</h6>
                    </div>
                    <div class="card-body">
                        <p>Export a list of all customers with their details.</p>
                        <a href="{{ route('admin.reports.customers') }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> Export Customers
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Order Reports</h6>
                    </div>
                    <div class="card-body">
                        <p>Export a list of all orders with their details.</p>
                        <a href="{{ route('admin.reports.orders') }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> Export Orders
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Manga Reports</h6>
                    </div>
                    <div class="card-body">
                        <p>Export a list of all manga titles with their details.</p>
                        <a href="{{ route('admin.reports.items') }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> Export Manga
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Sales Reports</h6>
                    </div>
                    <div class="card-body">
                        <p>Export a detailed sales report for a specific period.</p>
                        <form action="{{ route('admin.reports.sales') }}" method="GET">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-01') }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary d-block w-100">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

