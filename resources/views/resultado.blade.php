<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Resultado de búsqueda</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card mt-5 shadow">

<div class="card-body">
<div class="card-body text-center">

<!-- LOGO -->
<img src="{{ asset('images/isologotipo_unco-azul.png') }}" 
     alt="Logo Universidad" 
     style="max-height: 80px;" 
     class="mb-2">
</div>

<h3 class="mb-3 text-center">
    Universidad Nacional del Comahue
</h3>

<h5 class="mb-4 text-center">
Resultado
</h5>

@if(!$persona)

<div class="alert alert-danger">
No se encontró información para el DNI ingresado.
</div>

@else

<p>
<strong>Nombre:</strong>
{{ $persona->nombre }}

<br>

<strong>Apellido:</strong>
{{ $persona->apellido }}

<br>

<strong>DNI:</strong>
{{ $persona->dni }}
</p>

<hr>

@foreach($persona->inscripciones as $ins)

<p>

<strong>Año:</strong>
{{ $ins->padron->anio ?? '-' }}

<br>

<strong>Facultad:</strong>
{{ $ins->padron->facultad->nombre ?? '-' }}

<br>

<strong>Claustro:</strong>
{{ $ins->padron->claustro->nombre ?? '-' }}

<br>

<strong>Sede:</strong>
{{ $ins->padron->sede->nombre ?? '-' }}

</p>

<hr>

@endforeach

@endif

<div class="d-grid">

<a href="/" class="btn btn-secondary">

Nueva búsqueda

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>