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
        Schema::table('noticias', function (Blueprint $table) {
            $table->string('foto_perfil')->nullable();
        });
    }

    public function down()
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropColumn('foto_perfil');
        });
    }
};
