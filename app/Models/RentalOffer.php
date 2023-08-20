<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalOffer extends Model
{
    use HasFactory;
    protected $table = "rental_offers";

    protected $fillable = [
        'description',
        'type',
        'status',
        'title',
        'moving_date',
        'rent_amount',
        'address',
        'availability_date',
        'user_id',
        'city_id',
        'roommate'
    ];

    // Relacion con User
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion con favoritos
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    //Relacion con imagenes
    public function images(){
        return $this->hasMany(Image::class);
    }

    // Relacion con ciudad
    public function city(){
        return $this->belongsTo(City::class);
    }
}
