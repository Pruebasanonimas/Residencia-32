<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progreso extends Model
{
    use HasFactory;

    protected $fillable = ['alumno_id', 'leccion_id', 'completado'];

    public function alumno()
    {
        return $this->belongsTo(Alumnoe::class, 'alumno_id');
    }

    public function leccion()
    {
        return $this->belongsTo(Leccion::class, 'leccion_id');
    }
}
