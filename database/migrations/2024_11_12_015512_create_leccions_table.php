<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeccionsTable extends Migration
{
    public function up()
    {
        Schema::create('leccions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('contenido');
            $table->foreignId('curso_id')->constrained()->onDelete('cascade'); // Relación con cursos (toma el id del curso)
            $table->timestamps();
        });
    }
}
