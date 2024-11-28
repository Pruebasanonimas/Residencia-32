<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResetTokenToAlumnoesTable extends Migration
{
    public function up()
    {
        Schema::table('alumnoes', function (Blueprint $table) {
            $table->string('reset_token', 60)->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('alumnoes', function (Blueprint $table) {
            $table->dropColumn('reset_token');
        });
    }
}
