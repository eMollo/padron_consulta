<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaPadronController;

Route::get('/', [ConsultaPadronController::class, 'index']);

Route::post('/buscar', [ConsultaPadronController::class, 'buscar'])->middleware('throttle:5,1');

Route::get('/descargas/nota-opcion', function () {
    return response()->download(
        public_path('docs/nota_opcion.docx'),
        'Nota_Opcion_Padron_UNCO.docx'
    );
})->name('descargar.nota.opcion');


Route::get('/descargas/nota-reclamo', function () {
    return response()->download(
        public_path('docs/nota_inclusion.docx'),
        'Nota_Inclusión_Padron_UNCO.docx'
    );
})->name('descargar.nota.inclusion');