<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaPadronController;

Route::get('/', [ConsultaPadronController::class, 'index']);

Route::post('/buscar', [ConsultaPadronController::class, 'buscar'])->middleware('throttle:5,1');