<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RecuperarContraseñaMail extends Mailable
{
    public $token;  // Variable pública para el token, necesario si o si para funcionar 

    // Constructor para recibir el token
    public function __construct($token)
    {
        $this->token = $token;
    }

    // Método para construir el correo
    public function build()
    {
        return $this->subject('Recuperación de Contraseña')  // Asunto del correo
            ->view('alumno.emails.recuperar_contraseña')  // Vista del cuerpo del correo
            ->with(['token' => $this->token]);  // Pasar el token a la vista
    }
}
