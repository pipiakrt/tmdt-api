<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'birthday',
        'gender',
        'phone',
        'wallet',
        'email'
    ];

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getbirthday()
    {
        return date('d/m/Y', strtotime($this['birthday']));
    }

   
    public function favourite()
    {
        return $this->belongsToMany(Product::class);
    }

    public function bankingHistory()
    {
        return $this->hasMany(BankingHistory::class);
    }

    public function bankAccount()
    {
        return $this->hasMany(BankAccount::class);
    }
}
