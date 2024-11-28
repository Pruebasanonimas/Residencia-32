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
        Schema::create('alumnoes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('escuela');
            $table->string('especialidad');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('domicilio');
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password');
            $table->rememberToken();
            $table->string('role')->default('alumno');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnoes');
    }
};
