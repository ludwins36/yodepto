<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";

    protected $fillable = [
        'city_name',
        'province_id'
    ];

    // Relacion con provincias
    public function province(){
        return $this->belongsTo(Province::class);
    }

    // Relacion con rental offers
    public function rentalOffers(){
        return $this->hasMany(RentalOffer::class);
    }
}
