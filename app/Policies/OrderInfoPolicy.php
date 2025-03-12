<?php

namespace App\Policies;

use App\Models\OrderInfo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Everyone can view their orders, but what they see depends on implementation
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrderInfo $order): bool
    {
        return $user->isAdmin() || $user->isStaff() || 
               ($user->customer && $user->customer->id === $order->customer_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isActive(); // Any active user can create an order
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrderInfo $order): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrderInfo $order): bool
    {
        return $user->isAdmin();
    }
}

