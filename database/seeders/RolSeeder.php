<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'name_rol' => 'admin',
            'description' => 'Administrador del sistema'
        ]);
        Rol::create([
            'name_rol' => 'propietario',
            'description' => 'Propietario en el sistema'
        ]);
        Rol::create([
            'name_rol' => 'inquilino',
            'description' => 'Inquilino en el sistema'
        ]);
    }
}
