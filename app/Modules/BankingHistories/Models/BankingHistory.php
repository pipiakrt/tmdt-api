<?php

namespace Modules\Account\Models;

use Spatie\Permission\Traits\HasRoles;
use App\Models\BankingHistory as BankingHistories;

class BankingHistory extends \App\Models\BankingHistories
{
    use HasRoles;
}
