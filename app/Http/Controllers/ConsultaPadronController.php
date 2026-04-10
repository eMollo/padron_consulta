<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ConsultaPadronController extends Controller
{
    public function index()
    {
        return view('consulta');
    }

    public function buscar(Request $request)
{
    // 1. Validar DNI y presencia del token de reCAPTCHA
    $request->validate([
        'dni' => 'required',
        'g-recaptcha-response' => 'required'
    ], [
        'g-recaptcha-response.required' => 'Por favor, completá el captcha para continuar.'
    ]);

    // 2. Verificación con Google 
    try {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'), // Usando config en vez de env
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->successful() || !$response->json('success')) {
            return back()
                ->withInput() 
                ->withErrors(['captcha' => 'La validación del captcha falló. Reintentá.']);
        }
    } catch (\Exception $e) {
        
        return back()->withErrors(['captcha' => 'Error de conexión al verificar el captcha.']);
    }
    
    sleep(1); 

    $dni = preg_replace('/\D/', '', $request->dni);
    $anioActual = \Carbon\Carbon::now()->year;

    $persona = Persona::where('dni', $dni)
        ->with([
            'inscripciones' => function ($q) use ($anioActual) {
                $q->whereNull('deleted_at')
                  ->whereHas('padron', function ($q2) use ($anioActual) {
                      $q2->where('anio', $anioActual);
                  });
            },
            'inscripciones.padron.facultad',
            'inscripciones.padron.claustro',
            'inscripciones.padron.sede'
        ])
        ->first();

    return view('resultado', compact('persona'));
}
    

    /*public function buscar(Request $request)
    {
        $request->validate([
            'dni' => 'required'
        ]);

        sleep(1);

        $dni = preg_replace('/\D/', '', $request->dni);

        $persona = Persona::where('dni', $dni)
            ->with([
                'inscripciones' => function ($q) {
                    $q->whereNull('deleted_at'); //  CLAVE
                },
                'inscripciones.padron.facultad',
                'inscripciones.padron.claustro',
                'inscripciones.padron.sede'
            ])
            ->first();

        return view('resultado', compact('persona'));
    }*/
}
