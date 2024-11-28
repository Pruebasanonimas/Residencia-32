<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnoes'; 

    protected $fillable = [
        'nombre', 
        'mail',
        'password',
        'token', 
    ];

    protected $hidden = [
        'password',
        'token', 
    ];
}
