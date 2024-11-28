<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'estrellas',
        'author_id', 
        'author_type', 
    ];

   
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    
    public function author()
    {
        return $this->morphTo();
    }
}
