<?php
// database/migrations/2024_11_21_011619_create_like_alumnoe_noticia_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeAlumnoeNoticiaTable extends Migration
{
    public function up()
    {
        Schema::create('like_alumnoe_noticia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumnoe_id')->constrained()->onDelete('cascade');
            $table->foreignId('noticia_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('like_alumnoe_noticia');
    }
}
