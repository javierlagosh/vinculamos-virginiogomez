<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Inicio de sesión - Vinculamos</title>
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

        <form action="{{ route('reset.password.post') }}" method="POST">
            @csrf
            <!-- Mensajes de Error -->
            @foreach (['email', 'password', 'password_confirmation'] as $field)
                @if ($errors->has($field))
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first($field) }}</strong>
                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
            @endforeach
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email_address" class="label">Correo</label>
                <input type="text" id="email_address" class="form-control" name="email" required autofocus>

            </div>

            <div class="form-group">
                <label class="label" for="clave">Contraseña</label>
                <input type="password" id="password" class="form-control" name="password" required autofocus>
            </div>

            <div class="form-group">
                <label class="label" for="clave">Confirmar Contraseña</label>
                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required
                    autofocus>
            </div>
            <div class="form-group">
                <button type="submit" class="form-control btn rounded submit">Restablecer Contraseña</button>
            </div>
        </form>

        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/popper.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>
