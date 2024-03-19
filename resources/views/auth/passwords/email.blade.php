<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Restablecer Contraseña - Vinculamos</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/css/reset.password.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/estilos.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href={{ '/img/fav.png' }} />
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
</head>

<body>
    <div class="container">
        <img src="{{ '/img/logo.png' }}" alt="Imagen" class="img-fluid">
        <div class="card-body">
            <form method="POST" action="{{ route('forget.password.post') }}">
                @csrf
                <!-- Mensajes de Error -->
                @foreach (['message', 'error'] as $sessionKey)
                    @if (session($sessionKey))
                        <div class="alert alert-{{ $sessionKey === 'message' ? 'success' : 'danger' }}">
                            <strong>{{ session($sessionKey) }}</strong>
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif
                @endforeach
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                <div class="form-group">
                    <label class="label" for="email">{{ __('Correo') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                </div>

                <div class="form-group btn-container">
                    <button class="form-control btn rounded submit">{{ __('Restablecer') }}</button>
                    <a href="{{ route('ingresar.formulario') }}"
                        class="form-control btn rounded submit">{{ __('Cancelar') }}</a>
                </div>
            </form>
        </div>

        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/popper.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>
