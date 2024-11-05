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
        <link rel='shortcut icon' type='image/x-icon' href={{ '/img/logos/logo_vg_color.png' }} />
        <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
    </head>

    {{-- <body style="background-image: url({{asset('img/logos/twk-fondo.jpeg')}})"> --}}
    <body>
        <div class="container">
            <img src="{{ '/img/logos/logo_vg_color.png' }}" alt="Imagen" class="img-fluid">
            <form action="{{ route('auth.ingresar') }}" class="signin-form" method="POST">
                @csrf

                @if (Session::has('message'))
                        <div class="alert alert-success alert-dismissible show fade text-center">
                            <div class="alert-body">
                                <strong>{{ Session::get('message') }}</strong>
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        </div>
                      @endif
                <!-- Mensajes de Error -->
                @foreach (['errorName', 'errorClave', 'sessionFinalizada', 'usuarioRegistrado', 'errorCreate', 'exitoCreacion'] as $messageKey)
                    @if (Session::has($messageKey))
                        <div class="alert alert-{{ strpos($messageKey, 'error') !== false ? 'danger' : 'success' }}">
                            <strong>{{ Session::get($messageKey) }}</strong>
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif
                @endforeach
                <!-- Inicio del Formulario -->
                <div class="form-group">
                    <label class="label" for="nickname">Nombre de Usuario</label>
                    <input type="text" class="form-control" placeholder="Ingrese su Nombre de Usuario"
                        name="nickname" id="nickname" value="{{ old('nickname') }}" required autofocus> 
                    @if ($errors->has('nickname'))
                        <div class="alert alert-warning mt-2">
                            <strong>{{ $errors->first('nickname') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="label" for="clave">Contraseña</label>
                    <input type="password" class="form-control" placeholder="Ingrese su contraseña" required
                        id="clave" name="clave" autofocus>
                    @if ($errors->has('clave'))
                        <div class="alert alert-warning mt-2">
                            <strong>{{ $errors->first('clave') }}</strong>
                        </div>
                    @endif
                </div>
                <!-- Olvidaste contraseña -->
                @if (Route::has('forget.password.get'))
                    <div class="form-group forgot-password-container">
                        <a class="forgot-password-link" href="{{ route('forget.password.get') }}">
                            <strong>{{ __('¿Olvidaste tu contraseña?') }}</strong>
                        </a>
                    </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="form-control btn rounded submit">Ingresar</button>
                </div>
            </form>
        </div>
        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/popper.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/main.js') }}"></script>
    </body>

    </html>
