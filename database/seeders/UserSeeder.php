<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Yodepto',
            'email' => 'admin@yodepto.com',
            'password' => Hash::make('yodepto2023admin'),
            'phone' => '3810000000',
            'status' => 'activo',
            'rol_id' => 1
        ]);
        User::create([
            'first_name' => 'Propietario',
            'last_name' => 'Yodepto',
            'email' => 'propietario@yodepto.com',
            'password' => Hash::make('yodepto2023propietario'),
            'phone' => '3810000000',
            'status' => 'activo',
            'rol_id' => 2
        ]);
        User::create([
            'first_name' => 'Inquilino',
            'last_name' => 'Yodepto',
            'email' => 'inquilino@yodepto.com',
            'password' => Hash::make('yodepto2023inquilino'),
            'phone' => '3813850402',
            'status' => 'activo',
            'rol_id' => 3
        ]);
    }
}
