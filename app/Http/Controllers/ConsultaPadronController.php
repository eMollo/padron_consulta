<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

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
    }
}

/*namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

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

        sleep(1); // Simula un retraso para probar el middleware de throttling

        $dni = preg_replace('/\D/', '', $request->dni);

        $persona = Persona::where('dni', $dni)
            ->with([
                'inscripciones.padron.facultad',
                'inscripciones.padron.claustro',
                'inscripciones.padron.sede'
            ])
            ->first();

        return view('resultado', compact('persona'));
    }
}*/
