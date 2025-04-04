<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = Auth::user();
        $customer = $user->customer;
        
        return view('profile.edit', compact('user', 'customer'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
            'title' => 'nullable|string|in:Mr,Mrs,Ms,Dr,Prof',
            'fname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'lname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'addressline' => 'required|string|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9\+\-\s]+$/',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Verify current password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors([
                    'current_password' => 'The provided password does not match your current password.',
                ]);
            }
        }
        
        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            
            $user->photo = $request->file('photo')->store('user-photos', 'public');
        }
        
        $user->save();
        
        // Update or create customer data
        $customer = $user->customer;
        
        if ($customer) {
            $customer->update([
                'title' => $validated['title'],
                'fname' => $validated['fname'],
                'lname' => $validated['lname'],
                'addressline' => $validated['addressline'],
                'phone' => $validated['phone'],
            ]);
        } else {
            Customer::create([
                'title' => $validated['title'],
                'fname' => $validated['fname'],
                'lname' => $validated['lname'],
                'addressline' => $validated['addressline'],
                'phone' => $validated['phone'],
                'user_id' => $user->id,
            ]);
        }
        
        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}