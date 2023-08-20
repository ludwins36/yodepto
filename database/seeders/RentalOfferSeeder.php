<?php

namespace Database\Seeders;

use App\Models\RentalOffer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RentalOffer::create([
            'description' => 'esta es una descripcion de una propiedad',
            'type' => 'propiedad',
            'status' => 'activo',
        ]);
        RentalOffer::create([
            'description' => 'esta es una descripcion de una solicitud de alquiler',
            'type' => 'inquilino',
            'status' => 'activo',
        ]);
    }
}
