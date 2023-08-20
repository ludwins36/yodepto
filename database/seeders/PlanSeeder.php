<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'=> 'Plan Full',
            'description'=> 'Es el mejor plan de todos',
            'mount'=> 1000,
            'status' => 'activo',
        ]);
        Plan::create([
            'name'=> 'Plan Intermedio',
            'description'=> 'Es el intermedio',
            'mount'=> 500,
            'status' => 'activo',
        ]);
    }
}
