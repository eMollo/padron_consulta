<!DOCTYPE html>
<html>

<head>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de padrón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-11">

                <div class="mt-5 mb-3 p-3 bg-warning-subtle border-top border-4 border-warning shadow-sm text-center rounded">
                    <strong>📢 ¡ATENCIÓN!</strong><br>
                    🔎 Revisá los padrones provisorios.<br>
                    Buscate en los padrones elaborados por las unidades académicas.<br>
                    ⚠️ Si aparecés más de una vez, tenés que optar por uno<br>
                    y solicitarlo por nota a la Junta Electoral.<br>
                    Tenés tiempo hasta el 17 de Abril a las 16:00 hs.<br>
                    📩 
                    <a href="mailto:consejo.superior.unco@gmail.com" class="fw-semibold">
                        consejo.superior.unco@gmail.com
                    </a>
                </div>

                <div class="card shadow">
                    <div class="card-body text-center">

                        <img src="{{ asset('images/isologotipo_unco-azul.png') }}" 
                             alt="Logo Universidad" 
                             style="max-height: 80px;" 
                             class="mb-3">

                        <h3 class="mb-3">Universidad Nacional del Comahue</h3>
                        <h5 class="mb-4">Consulta de padrón electoral</h5>

                        <form method="POST" action="/buscar">
                            @csrf

                            <div class="mb-3 text-start">
                                <label class="form-label">Ingrese su DNI</label>
                                <input type="text" name="dni" class="form-control" required placeholder="Sin puntos ni espacios">
                            </div>

                            <div class="mb-3 d-flex justify-content-center">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                            </div>

                            @if ($errors->has('g-recaptcha-response') || $errors->has('captcha'))
                                <div class="alert alert-danger py-2 small">
                                    Debes completar el captcha correctamente.
                                </div>
                            @endif

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    CONSULTAR
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