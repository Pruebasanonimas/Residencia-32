<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'curso_id']; 

   
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

   
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function resultados()
    {
        return $this->hasMany(ResultadoExamen::class, 'exam_id');
    }
}
