<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('calificacion_cursos', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id');
            $table->string('author_type');
        });
    }

    public function down()
    {
        Schema::table('calificacion_cursos', function (Blueprint $table) {
            $table->dropColumn(['author_id', 'author_type']);
        });
    }
};
