<?php

namespace Database\Seeders;

use App\Models\Empleado;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

// use App\Models\Empleado_chk;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empleado = Empleado::factory(149)->create();
    }
}
