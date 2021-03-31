<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'cmnd',
        'name',
        'banking_name',
        'banking_number',
        'province',
        'banking_branch'
    ];
}
