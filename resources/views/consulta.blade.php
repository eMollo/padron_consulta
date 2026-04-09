<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Consulta de padrón</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center">

<div class="col-md-6">

<!-- BANNER AMARILLO -->
<div class="mt-5 mb-3 p-3 bg-warning-subtle border-top border-4 border-warning shadow-sm text-center rounded">

    <strong>📢 ¡ATENCIÓN!</strong><br>

    🔎 Revisá los padrones provisorios.<br>
    Buscate en los padrones elaborados por las unidades académicas.<br>

    ⚠️ Si aparecés más de una vez, solicitá figurar en uno solo.<br>
    Tenés tiempo de optar hasta el 17 de Abril, 16:00 hs.<br>

    📩 
    <a href="mailto:consejo.superior.unco@gmail.com" class="fw-semibold">
        consejo.superior.unco@gmail.com
    </a>

</div>

<!-- CARD BUSCADOR -->
<div class="card shadow">

<div class="card-body text-center">

<!-- LOGO -->
<img src="{{ asset('images/isologotipo_unco-azul.png') }}" 
     alt="Logo Universidad" 
     style="max-height: 80px;" 
     class="mb-3">

<h3 class="mb-3">
    Universidad Nacional del Comahue
</h3>

<h5 class="mb-2">
Consulta de padrón electoral  
</h5>

<form method="POST" action="/buscar">

@csrf

<div class="mb-3 text-start">

<label class="form-label">
Ingrese su DNI
</label>

<input
type="text"
name="dni"
class="form-control"
required
>

</div>

<div class="d-grid">

<button class="btn btn-primary">
Buscar
</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>