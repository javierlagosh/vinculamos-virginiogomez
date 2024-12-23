<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Inicio de sesión - Vinculamos</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/reset.password.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/estilos.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href=""/>
    {{-- Logito de la pestaña --}}

</head>

<body
    style=" background-color: #515151;border-color: #515151; background:  url({{ '/img/logos/frontis-ipvg.webp' }})   ;background-size:cover; background-repeat:repeat;background-attachment: fixed;background-position: center;">
    <section class="ftco-section" style="margin-right: 1%; display: flex; align-items:center;">
        <div class="container" style="background: rgba(255,255,255,0.50);  border-radius: 50px; width:500px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center" style="border-radius: 50px; margin: 0 auto;">
                        <img src="{{ '/img/logos/logo_vg_color.png' }}" alt="Imagen" class="img-fluid mt-3">
                    </div>
                </div>
            </div>
            <div class="row mt-4" style="width:100%;  margin-left: 0%;">
                <div class="col-md-10 offset-md-3" style="background-color:;margin: 0 auto;">
                    <!-- <div style=" color:black;">{{ __('Reset Password') }}</div> -->
                    <div class="card-body">

                        @if (Session::has('exito'))
                        <div class="alert alert-success alert-dismissible show fade text-center">
                            <div class="alert-body">
                                <strong>{{ Session::get('exito') }}</strong>
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        </div>
                      @endif

                      @if (Session::has('error'))
                          <div class="alert alert-danger alert-dismissible show fade text-center">
                              <div class="alert-body">
                                  <strong>{{ Session::get('error') }}</strong>
                                  <button class="close" data-dismiss="alert"><span>&times;</span></button>
                              </div>
                          </div>
                      @endif

                      @if($usuario)
                        <form action="{{ route('reset.password.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <label style="color:black;" class="font-weight-bold">Correo: <span class="font-weight-normal">{{$usuario->email}}</span></label>

                                <input style="background-color:white; color:black; border: 1px solid #e76800;"
                                    type="hidden" id="email_address" class="form-control" name="email" required value="{{$usuario->email}}"
                                    autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif

                            </div>

                            <div class="form-group ">
                                <label for="password" class="label">Contraseña</label>

                                <input style="background-color:white; color:black; border: 1px solid #e76800;"
                                    type="password" id="password" class="form-control" name="password" required
                                    autofocus>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif

                            </div>

                            <div class="form-group ">
                                <label for="password-confirm" class="label">Confirmar Contraseña</label>

                                <input style="background-color:white; color:black; border: 1px solid #e76800;"
                                    type="password" id="password-confirm" class="form-control"
                                    name="password_confirmation" required autofocus>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif

                            </div>

                            <div class="form-group">
                                <button style="background-color:#e76800; color:white;margin-top:5%;" type="submit"
                                    class="form-control btn rounded submit px-3">
                                    Restablecer Contraseña
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger alert-dismissible show fade text-center">
                            <div class="alert-body text-center">
                                <strong>El token de recuperación de contraseña no es válido.
                                    <br>
                                    <a class="btn btn-primary" href="/ingresar">Volver</a>
                                </strong>
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                    @endif
                    </div>
                </div>
            </div>
    </section>

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>
