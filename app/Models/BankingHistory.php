<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type',
        'banking_number',
        'amount_prev',
        'amount_payment',
        'amount_next',
        'content'
    ];
}
