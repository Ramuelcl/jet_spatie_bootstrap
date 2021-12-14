<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre' => $this->faker->name(),
            'ApellidoPaterno' => $this->faker->firstName(),
            'ApellidoMaterno' => $this->faker->lastName(),
            'Correo' => $this->faker->unique()->safeEmail(),
            'Foto' =>
            // 'empleado/'.$this->faker('public/storage/images', 650, 490, null, false),
            // 'empleado/'.$this->faker->image(storage_path('images'), $width = 640, $height = 480),
            $this->faker->image(public_path('images'), $width = 640, $height = 480, false),
            'Texto' =>  $this->faker->text($maxNbChars = 200),
            'Moneda' =>  $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 9999999.99), // 48.8932


       ];
    }
}
