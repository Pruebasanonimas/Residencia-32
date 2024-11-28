<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = ['cuerpo', 'imagen', 'autor', 'foto_perfil'];


    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
