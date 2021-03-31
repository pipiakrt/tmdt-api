<?php

namespace Modules\Cart\Models;

use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Cart extends \App\Models\Cart
{
    use HasRoles, Cachable;

}
