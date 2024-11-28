<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calificacion_cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade'); // Relación con curso
            $table->integer('estrellas')->unsigned()->comment('Calificación de 1 a 5 estrellas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calificacion_cursos');
    }
};
