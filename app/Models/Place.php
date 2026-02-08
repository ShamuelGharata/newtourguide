<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    // PASTE THIS HERE
    protected $fillable = [
        'name', 
        'description', 
        'image_url', 
        'address', 
        'phone', 
        'category_id'
    ];

    // One place has many reviews
    public function reviews() {
        return $this->hasMany(Review::class, 'place_id');
    }

    // One place has many facilities
    public function facilities() {
        return $this->belongsToMany(Facility::class, 'place_facilities', 'place_id', 'facility_id');
    }
}