<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            $table->string('Nombre', 50);
            $table->string('ApellidoPaterno', 50);
            $table->string('ApellidoMaterno', 50);
            $table->string('Correo', 50);
            $table->string('Foto');
            $table->text('Texto');
            $table->decimal('moneda', 10, 2);
            $table->foreign('chk_id')->references('id')->on('empleado_chk');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
