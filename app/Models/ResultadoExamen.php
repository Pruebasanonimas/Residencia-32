<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoExamen extends Model
{
    use HasFactory;

    protected $table = 'resultados_examenes'; 

    protected $fillable = ['alumno_id', 'exam_id', 'puntaje', 'porcentaje'];

    public function alumno()
    {
        return $this->belongsTo(Alumnoe::class, 'alumno_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
