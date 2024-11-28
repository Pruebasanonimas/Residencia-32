<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumnoe;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RecuperarContraalumnoController extends Controller
{
    // Mostrar el formulario de recuperación de contraseña
    public function mostrarFormularioRecuperacion()
    {
        return view('alumno.recuperar-contraseña');
    }

    // Enviar correo de recuperación de contraseña
    public function enviarCorreoRecuperacion(Request $request)
    {
        $request->validate([
            'email' => 'required|email', 
        ]);

        $alumno = Alumnoe::where('email', $request->email)->first();

        if (!$alumno) {
            return redirect()->back()->with('error', 'Correo no registrado');
        }

        // Generar un token único para el enlace de restablecimiento
        $token = Str::random(60);
        $alumno->reset_token = $token;
        $alumno->save();

        Mail::send('alumno.emails.recuperar_contraseña', ['token' => $token], function ($message) use ($alumno) {
            $message->to($alumno->email)
                ->subject('Recuperación de Contraseña');
        });
        return redirect()->route('alumno.recuperar-contraseña')->with('success', 'Correo enviado. Revisa tu bandeja de entrada.');
    }

    // Mostrar el formulario de restablecimiento de contraseña
    public function mostrarFormularioRestablecimiento($token)
    {
        // Pasar el token al formulario de restablecimiento
        return view('alumno.restablecer-contraseña', ['token' => $token]);
    }

    // Actualizar la contraseña
    public function actualizarContraseña(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Buscar al alumno por el token
        $alumno = Alumnoe::where('reset_token', $request->token)->first();
        if (!$alumno) {
            return redirect()->route('alumno.recuperar-contraseña')->with('error', 'Token inválido o expirado.');
        }

        // Actualizar la contraseña del alumno
        $alumno->password = Hash::make($request->password);
        $alumno->reset_token = null; // Limpiar el token después de restablecer la contraseña
        $alumno->save();

        return redirect()->route('alumno.login')->with('success', 'Contraseña actualizada correctamente. Ahora puedes iniciar sesión.');
    }
}
