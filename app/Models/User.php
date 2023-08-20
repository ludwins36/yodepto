<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'url_photo',
        'first_name',
        'last_name',
        'status',
        'rol_id',
        'profession'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relacion con roles
    public function rol(){
        return $this->belongsTo(Rol::class);
    }

    //Relacion con avisos
    public function rentalOffers(){
        return $this->hasMany(RentalOffer::class);
    }

    //Relacion con favoritos
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    //Relacion con pagos
    public function payments(){
        return $this->hasMany(Payment::class);
    }

    // Relacion con chats
    public function chats(){
        return $this->belongsToMany(Chat::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function ultimoPago()
    {
        return $this->hasOne(Payment::class)->latest();
    }
}
