<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Customer::class);
        
        return view('admin.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Customer::class);
        
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Customer::class);
        
        $validated = $request->validate([
            'title' => 'nullable|string|in:Mr,Mrs,Ms,Dr,Prof',
            'fname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'lname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'addressline' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9\+\-$$$$\s]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = User::create([
            'name' => $validated['fname'] . ' ' . $validated['lname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
            'status' => 'activated',
        ]);
        
        Customer::create([
            'title' => $validated['title'],
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'addressline' => $validated['addressline'],
            'phone' => $validated['phone'],
            'user_id' => $user->id,
        ]);
        
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $this->authorize('view', $customer);
        
        $customer->load(['user', 'orders' => function($query) {
            $query->with(['status', 'orderLines' => function($query) {
                $query->with('item');
            }]);
        }]);
        
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);
        
        $customer->load('user');
        
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $this->authorize('update', $customer);
        
        $validated = $request->validate([
            'title' => 'nullable|string|in:Mr,Mrs,Ms,Dr,Prof',
            'fname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'lname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'addressline' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9\+\-$$$$\s]+$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $customer->user_id,
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:activated,deactivated',
        ]);
        
        $customer->update([
            'title' => $validated['title'],
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'addressline' => $validated['addressline'],
            'phone' => $validated['phone'],
        ]);
        
        $updateUserData = [
            'name' => $validated['fname'] . ' ' . $validated['lname'],
            'email' => $validated['email'],
            'status' => $validated['status'],
        ];
        
        if ($validated['password']) {
            $updateUserData['password'] = Hash::make($validated['password']);
        }
        
        $customer->user()->update($updateUserData);
        
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);
        
        $userId = $customer->user_id;
        
        $customer->delete();
        
        User::destroy($userId);
        
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    /**
     * Get customers data for DataTables.
     */
    public function getData()
    {
        $customers = Customer::with('user');
        
        return DataTables::of($customers)
            ->addColumn('name', function($customer) {
                return $customer->full_name;
            })
            ->addColumn('email', function($customer) {
                return $customer->user->email;
            })
            ->addColumn('status', function($customer) {
                return $customer->user->status;
            })
            ->addColumn('actions', function($customer) {
                return view('admin.customers.actions', compact('customer'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}

