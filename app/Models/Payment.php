<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";

    protected $fillable = [
        'date_payment',
        'date_from',
        'date_to',
        'payment_amount',
        'user_id',
        'plan_id'
    ];

    // Relacion con usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relacion con plan
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
