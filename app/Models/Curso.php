<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion',
        'precio',
        'estado',
        'profesor_id',
        'imagen'
    ];

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, 'curso_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }


    public function calificaciones()
    {
        return $this->hasMany(CalificacionCurso::class);
    }

    public function promedioEstrellas()
    {
        return $this->calificaciones()->avg('estrellas') ?? 0; // Devuelve 0 si no hay calificaciones
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'inscripcions', 'curso_id', 'alumno_id');
    }

    public function examen()
    {
        return $this->hasOne(Exam::class, 'curso_id');
    }



    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
