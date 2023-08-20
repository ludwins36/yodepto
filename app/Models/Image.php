<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = "images";

    protected $fillable = [
        'url_photo',
        'rental_offer_id'
    ];

    // Relacion con Aviso
    public function rentalOffer(){
        return $this->belongsTo(RentalOffer::class, 'rental_offer_id', 'id');
    }
}
