<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityCodeController extends Controller
{
    // Mostrar el formulario de verificación del código de seguridad
    public function show()
    {
        return view('security-code');  
    }

    public function verify(Request $request)
    {
        $request->validate([
            'security_code' => 'required|string',
        ]);

        $correctCode = 'I21T8S1C9O99';

        if ($request->security_code === $correctCode) {
            session(['security_verified' => true]);
            return redirect()->route('register');
        }
        return back()->withErrors(['security_code' => 'Código de seguridad incorrecto.']);
    }
}
