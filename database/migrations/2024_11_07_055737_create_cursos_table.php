<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('duracion');
            $table->text('descripcion');
            $table->decimal('precio', 8, 2)->default(0);
            $table->boolean('estado')->default(1); // Activo por defecto, 1 = Activo - 0 = Inactivo
            $table->foreignId('profesor_id')->constrained('users')->onDelete('cascade'); // Relación con la tabla users (importante)
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
