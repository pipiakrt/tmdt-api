<?php

namespace Modules\Account\Models;

use Spatie\Permission\Traits\HasRoles;
use App\Models\Product;

class User extends \App\Models\User
{
    use HasRoles;

    public function favourite()
    {
        return $this->belongsToMany(Product::class);
    }
}
