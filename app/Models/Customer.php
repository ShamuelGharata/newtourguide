<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable 
{
    use Notifiable;
    
    protected $table = 'customer';
    public $timestamps = false; 
    protected $fillable = ['name', 'email', 'password', 'role_id'];
    public function favorites()
    {
        return $this->belongsToMany(Place::class, 'favorites', 'user_id', 'place_id');
    }
}