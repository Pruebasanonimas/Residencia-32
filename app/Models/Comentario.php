<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'curso_id',
        'comentario',
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
