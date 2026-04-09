<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Carbon\Carbon;

class ConsultaPadronController extends Controller
{
    public function index()
    {
        return view('consulta');
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'dni' => 'required'
        ]);

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
