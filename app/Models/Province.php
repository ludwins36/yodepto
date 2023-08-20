<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = "provinces";

    protected $fillable = [
        'province_name',
        'country_id'
    ];

    // Relacion con ciudades
    public function cities(){
        return $this->hasMany(City::class);
    }

    // Relacion con paises
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
