
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

<div class="card mt-5 shadow">

<div class="card-body">

<h3 class="text-center mb-4">
Consulta de padrón electoral
</h3>

<form method="POST" action="/buscar">

@csrf

<div class="mb-3">

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