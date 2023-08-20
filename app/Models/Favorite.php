<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = "favorites";

    protected $fillable = [
        'user_id',
        'rental_offer_id'
    ];

    // Relacion con Users
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relacion con Avisos
    public function rentalOffer(){
        return $this->belongsTo(RentalOffer::class);
    }
}
