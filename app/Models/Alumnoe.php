<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable; 


class Alumnoe extends Authenticatable implements MustVerifyEmail  
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'escuela',
        'especialidad',
        'telefono',
        'email',
        'domicilio',
        'password',
        'role',
    ];

    /**
     * 
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);  
    }

    /**
     * 
     * 
     *
     * @return void
     */
    public function markEmailAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * 
     * 
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->email;
    }

    /**
     * 
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmail); 
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'inscripcions', 'alumno_id', 'curso_id');
    }

    public function progresos()
    {
        return $this->hasMany(Progreso::class, 'alumno_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Noticia::class, 'like_alumnoe_noticia')->withTimestamps();
    }
}
