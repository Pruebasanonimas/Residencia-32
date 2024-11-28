<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('escuela');
            $table->string('especialidad');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->string('domicilio');
            $table->string('contraseña');
            $table->timestamps();
        });
    }
};
