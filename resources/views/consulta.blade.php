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

                <!-- ALERTA -->
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

                <!-- DESCARGAS -->
                <div class="mb-4 text-center">

                    <p class="mb-2 fw-semibold">
                        📄 Descargá los modelos de nota:
                    </p>

                    <div class="d-grid gap-2">

                        <a href="{{ route('descargar.nota.opcion') }}"
                           class="btn btn-outline-primary">
                            Descargar nota de opción
                        </a>

                        <a href="{{ route('descargar.nota.inclusion') }}"
                           class="btn btn-outline-secondary">
                            Descargar nota de inclusión
                        </a>

                    </div>

                    <small class="text-muted">
                        Usá estos modelos para presentar solicitudes ante la Junta Electoral.
                    </small>

                </div>

                <!-- FORM -->
                <div class="card shadow">
                    <div class="card-body text-center">
                        <img src="{{ asset('images/isologotipo_unco-azul.png') }}" alt="Logo" style="max-height: 80px;" class="mb-3">
                        <h3 class="mb-3">Universidad Nacional del Comahue</h3>
                        <h5 class="mb-4">Consulta de padrón electoral</h5>

                        <form id="formConsulta" method="POST" action="/buscar">
                            @csrf

                            <div class="mb-3 text-start">
                                <label class="form-label">Ingrese su DNI</label>
                                <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required placeholder="Sin puntos ni espacios">
                            </div>

                            @if ($errors->has('captcha'))
                                <div class="alert alert-danger py-2 small">
                                    {{ $errors->first('captcha') }}
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

    <script>
        document.getElementById('formConsulta').addEventListener('submit', function(e) {
            e.preventDefault();

            grecaptcha.ready(function() {
                grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", {action: 'consultar'}).then(function(token) {

                    let form = document.getElementById('formConsulta')

                    let input = document.createElement('input')
                    input.type = 'hidden'
                    input.name = 'g-recaptcha-response'
                    input.value = token

                    form.appendChild(input)
                    form.submit()
                })
            })
        })
    </script>

</body>
</html>