<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionPagina extends Model
{
    use HasFactory;

    /**
     * 
     */
    protected $fillable = [
        'contenido', // Contenido HTML o texto para la página (para quill)

    ];
}
