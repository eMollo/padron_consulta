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
        // 1. Validación básica
        $request->validate([
            'dni' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        // 2. Validación de reCAPTCHA v3 con Google
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => config('services.recaptcha.secret_key'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $json = $response->json();

            if (!$json['success'] || $json['score'] < 0.5) {
                return back()->withInput()->withErrors(['captcha' => 'Validación de seguridad fallida (Posible Bot).']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['captcha' => 'No se pudo verificar la seguridad. Reintentá.']);
        }

        // 3. Lógica de búsqueda
        sleep(1); 
        $dni = preg_replace('/\D/', '', $request->dni);
        $anioActual = Carbon::now()->year;

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
