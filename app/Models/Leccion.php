<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'titulo',
        'contenido'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function progresos()
    {
        return $this->hasMany(Progreso::class, 'leccion_id');
    }
}
