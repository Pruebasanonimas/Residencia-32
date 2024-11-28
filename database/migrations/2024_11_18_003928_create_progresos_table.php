<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('progresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('leccion_id');
            $table->boolean('completado')->default(false);
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('alumno_id')->references('id')->on('alumnoes')->onDelete('cascade');
            $table->foreign('leccion_id')->references('id')->on('leccions')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progresos');
    }
};
