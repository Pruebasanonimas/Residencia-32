<?php

namespace App\Http\Controllers\Auth;

use App\Models\Alumnoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class AlumnoeAuthController extends Controller
{
    // Función para mostrar el formulario de login
    public function showLoginForm()
    {
        return view('alumno.login');  
    }

    // Función para mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('alumno.register');  
    }

    // Función para registrar al alumno
    public function register(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'escuela' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:alumnoes',
            'domicilio' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
            'escuela_otras' => 'nullable|string|max:255',
            'especialidad_otras' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('alumno.register')
                ->withErrors($validator)
                ->withInput();
        }

      
        $escuela = $request->escuela === 'otras' ? $request->escuela_otras : $request->escuela;
        $especialidad = $request->especialidad === 'otras' ? $request->especialidad_otras : $request->especialidad;

       
        $alumno = Alumnoe::create([
            'nombre' => $request->nombre,
            'escuela' => $escuela,
            'especialidad' => $especialidad,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'domicilio' => $request->domicilio,
            'password' => Hash::make($request->password),
            'role' => 'alumno',
        ]);

       
        $alumno->sendEmailVerificationNotification();

      
        return redirect()->route('alumno.registro-exitoso')->with('status', '¡Registro completado con éxito!');
    }



    // Función para verificar el correo electrónico
    public function verifyEmail($id, $hash)
    {
        $alumno = Alumnoe::findOrFail($id);

       
        if (hash_equals($hash, sha1($alumno->getEmailForVerification()))) {
            $alumno->markEmailAsVerified();
            return redirect()->route('alumno.login')->with('status', 'Correo verificado con éxito.');
        }

        return redirect()->route('alumno.login')->withErrors(['email' => 'Enlace de verificación inválido.']);
    }

    
    // Función para iniciar sesión alumnos
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        
        $alumno = Alumnoe::where('email', $credentials['email'])->first();

        
        if (!$alumno || !Hash::check($credentials['password'], $alumno->password)) {
            return redirect()->back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
        }

       
        if ($alumno->email_verified_at === NULL) {
            return redirect()->back()->withErrors(['email' => 'Por favor, verifica tu correo electrónico antes de iniciar sesión.']);
        }

       
        Auth::guard('alumnoe')->login($alumno);

       
        return redirect()->route('alumno.principal');  
    }

    // Función para cerrar sesión alumno
    public function logout()
    {
        Auth::logout();
        return redirect()->route('alumno.login');
    }

    // Función para mostrar el formulario de recuperación de contraseña de los alumnos
    public function showPasswordResetForm()
    {
        return view('alumno.recuperar-contraseña');  
    }

    // Función para enviar el correo de recuperación de contraseña
    public function sendPasswordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:alumnoes,email', 
        ]);

        $alumno = Alumnoe::where('email', $request->email)->first();

        if (!$alumno) {
            return redirect()->back()->withErrors(['email' => 'Este correo no está registrado en nuestra base de datos.']);
        }

    
        return redirect()->route('alumno.login')->with('status', 'Te hemos enviado un correo con el enlace para restablecer tu contraseña.');
    }

    // Función para restablecer la contraseña alumnos
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8', 
        ]);

      
        $email = session('email');

        if (!$email) {
            return redirect()->route('alumno.recuperar-contraseña')->with('error', 'Correo no registrado o sesión expirada.');
        }

     
        $alumno = Alumnoe::where('email', $email)->first();

        if (!$alumno) {
            return redirect()->route('alumno.recuperar-contraseña')->with('error', 'Correo no registrado');
        }

      
        $alumno->password = Hash::make($request->password);  // Hashear la nueva contraseña
        $alumno->save();

   
        session()->forget('email');


        return redirect()->route('alumno.login')->with('success', 'Contraseña actualizada correctamente. Ahora puedes iniciar sesión.');
    }


    // Función para mostrar el formulario de edición de datos de los alumnos
    public function edit($id)
    {
       
        $alumno = Alumnoe::findOrFail($id);

       
        return view('alumno.editar', compact('alumno'));
    }

    // Función para actualizar los datos del alumno
    public function update(Request $request, $id)
    {
    
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'escuela' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'domicilio' => 'required|string|max:255',
            'escuela_otras' => 'nullable|string|max:255',
            'especialidad_otras' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('alumno.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

     
        $escuela = $request->escuela === 'otras' ? $request->escuela_otras : $request->escuela;
        $especialidad = $request->especialidad === 'otras' ? $request->especialidad_otras : $request->especialidad;

     
        $alumno = Alumnoe::findOrFail($id);
        $alumno->nombre = $request->nombre;
        $alumno->escuela = $escuela;
        $alumno->especialidad = $especialidad;
        $alumno->telefono = $request->telefono;
        $alumno->domicilio = $request->domicilio;

      
        $alumno->save();

       
        return redirect()->route('alumno.principal', $id)->with('status', '¡Datos actualizados con éxito!');
    }


 
    //Función para mostrar la vista de editar datos de alumnos
    public function mostrarFormularioActualizar()
    {
       
        $alumno = Auth::guard('alumnoe')->user();

    
        return view('alumno.editar', compact('alumno'));
    }
}
