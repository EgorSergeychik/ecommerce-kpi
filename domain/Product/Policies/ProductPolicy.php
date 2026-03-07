<?php

namespace Domain\Product\Policies;

use Domain\Product\Models\Product;
use Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

//    public function get(User $user, Product $product): bool
//    {
//    }

    public function create(User $user): bool
    {
        return $user->is_admin;
    }

//    public function update(User $user, Product $product): bool
//    {
//    }
//
//    public function delete(User $user, Product $product): bool
//    {
//    }
}
