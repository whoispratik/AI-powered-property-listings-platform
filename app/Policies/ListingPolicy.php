<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    /**
     * Determine whether the user can view any models.
     * would  run before this policy methods , if it returns true no further checks will be done and if
     */
    public function before(User $user, string $ability): bool|null
{
    if ($user->is_admin) {
        return true;
    }
 
    return null;
}
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Listing $listing): Response
    {
       return $user->id==$listing->user_id?Response::allow('granted'):Response::deny('You arent authorized to perform this');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): Response
    {
        return $user->id==$listing->user_id?Response::allow('granted'):Response::deny('You cant edit a listing you dont own.');

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): Response
    {
        return $user->id==$listing->user_id?Response::allow('granted'):Response::deny('You cant delete a listing you dont own');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing): bool
    {
        return false;
    }
    public function forSold(User $user,Listing $listing): Response | bool {
        // would either return null if it isnt sold and a timestamp if its sold
        return $listing->sold_at ?  Response::deny('The listing has been sold sorry') : true;
    }
}
