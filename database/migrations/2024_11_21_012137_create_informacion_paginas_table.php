<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionPaginasTable extends Migration
{
    public function up()
    {
        Schema::create('informacion_paginas', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('informacion_paginas');
    }
}
