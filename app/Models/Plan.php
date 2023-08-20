<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = "plans";

    protected $fillable = [
        'name',
        'description',
        'mount',
        'status',
        'link_mp',
        'duration'
    ];

    //Relacion con pagos
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
