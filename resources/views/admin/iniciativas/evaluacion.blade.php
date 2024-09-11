@if (Session::has('admin'))
    @php
        $role = 'admin';
    @endphp
@elseif (Session::has('digitador'))
    @php
        $role = 'digitador';
    @endphp
@elseif (Session::has('observador'))
    @php
        $role = 'observador';
    @endphp
@elseif (Session::has('supervisor'))
    @php
        $role = 'supervisor';
    @endphp
@endif

@extends('admin.panel')

@section('contenido')
    <div class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">

                        <div class="col-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 alert-container" id="exito_ingresar" style="display: none;">
                            <div class="alert alert-success show fade mb-4 text-center">
                                <div class="alert-body">
                                    <strong>Evaluación ingresada correctamente</strong>
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 alert-container" id="exito_crear" style="display: none;">
                            <div class="alert alert-success show fade mb-4 text-center">
                                <div class="alert-body">
                                    <strong>Evaluación creada correctamente</strong>
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            @if (Session::has('exito'))
                                <div class="alert alert-success alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <strong>{{ Session::get('exito') }}</strong>
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <strong>{{ Session::get('error') }}</strong>
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <div class="col-6 alert-container" id="error">

                        </div>
                        <div class="col-3"></div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h4>Evaluación de la iniciativa: {{ $iniciativa[0]->inic_nombre }} </h4>


                            <div class="card-header-action">
                                <div class="dropdown d-inline">

                                    <button class="btn btn-info dropdown-toggle" id="dropdownMenuButton2"
                                        data-toggle="dropdown">Iniciativas</button>

                                    <div class="dropdown-menu dropright">
                                        <a href="{{ route('admin.editar.paso1', $iniciativa[0]->inic_codigo) }}"
                                            class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                            title="Editar iniciativa"><i class="fas fa-edit"></i> Editar
                                            Iniciativa</a>

                                        <a href="{{ route('admin.iniciativas.detalles', $iniciativa[0]->inic_codigo) }}"
                                            class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                            title="Ver detalles de la iniciativa"><i class="fas fa-eye"></i> Mostrar
                                            detalles</a>
                                        {{-- <a href="javascript:void(0)" class="btn btn-icon btn-info icon-left"
                                            data-toggle="tooltip" data-placement="top" title="Calcular INVI"
                                            onclick="calcularIndice({{ $iniciativa[0]->inic_codigo }})"><i
                                                class="fas fa-tachometer-alt"></i>INVI</a> --}}

                                        <a href="{{ route('admin.evidencias.listar', $iniciativa[0]->inic_codigo) }}"
                                            class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                            title="Adjuntar evidencia"><i class="fas fa-paperclip"></i> Adjuntar
                                            evidencias</a>
                                    </div>

                                    <div class="dropdown d-inline">

                                        <button class="btn btn-success dropdown-toggle" id="dropdownMenuButton2"
                                            data-toggle="dropdown"><i class="fas fa-plus-circle"></i> Ingresar</button>

                                        <div class="dropdown-menu dropright">

                                            <a href="{{ route('admin.cobertura.index', $iniciativa[0]->inic_codigo) }}"
                                                class="dropdown-item has-item" data-toggle="tooltip"
                                                data-placement="top" title="Ingresar cobertura"><i
                                                    class="fas fa-users"></i> Ingresaer cobertura</a>

                                            <a href="{{ route('admin.ver.lista.de.resultados', $iniciativa[0]->inic_codigo) }}"
                                                class="dropdown-item has-item" data-toggle="tooltip"
                                                data-placement="top" title="Ingresar resultado"><i
                                                    class="fas fa-flag"></i> Ingresar resultado/s</a>
                                        </div>
                                    </div>



                                    {{-- <a href="{{ route($role . '.evaluar.iniciativa', $iniciativa[0]->inic_codigo) }}"
                                            class="btn btn-icon btn-success icon-left" data-toggle="tooltip"
                                            data-placement="top" title="Evaluar iniciativa"><i
                                                class="fas fa-file-signature"></i>Evaluar</a> --}}

                                    <a href="{{ route('admin.iniciativa.listar') }}"
                                        class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                        <i class="fas fa-angle-left"></i> Volver a listado
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4>Paso 1: Selecciona el tipo de evaluador</h4>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
                            <form method="POST" action="{{route('admin.crear.evaluacion')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="tipo">
                                        <strong>Tipo de evaluador:</strong>
                                    </label>
                                    <div class="w-100">
                                        <input type="text" hidden name="inic_codigo" id="inic_codigo"
                                        value="{{ $iniciativa[0]->inic_codigo }}">
                                        <select class="form-control" name="tipo" id="tipo" onchange="cambioTipo();" required>
                                            <option value="" disabled selected>Seleccione...</option>
                                            <option value="0">Evaluador interno - Estudiante</option>
                                            <option value="1">Evaluador interno - Docente/Directivo</option>
                                            <option value="2">Evaluador externo</option>
                                            {{-- <option value="4">Limpiar</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" id="botonEnviar" class="btn btn-primary w-100">
                                    Paso Siguiente &nbsp;<i class="fas fa-chevron-right"></i>
                                </button>
                            </form>



                            <script>
                                //funcion donde si cambia el tipo de evaluador se muestra el boton de enviar
                                onchange = function() {
                                    document.getElementById('botonEnviar').hidden = false;
                                }

                            </script>
                        </div>

                        @if (count($evaluaciones) > 0)
                        <div class="card-body">
                            <h4>Histórico</h4>
                            <table class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>Evaluador</th>
                                    {{-- <th>Fecha</th>
                                    <th>Evaluación</th>
                                    <th>Estatus</th> --}}
                                    <th>Ver resultados</th>
                                    <th>Agregar evaluadores</th>

                                </thead>
                                <tbody>
                                    @if (count($evatipoestudiantes) > 0)
                                    <tr>
                                        <td>0</td>
                                        <td>Evaluador interno - Estudiantes</td>
                                        <td><a href="{{ route('admin.ver.evaluacion', [$iniciativa[0]->inic_codigo, 0]) }}"
                                            class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                             <i class="fas fa-eye"></i> Ver resultados de la evaluación </a></td>
                                        <td><a href="{{ route('admin.iniciativa.evaluar.invitar', [$iniciativa[0]->inic_codigo, 0]) }}"
                                            class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                             <i class="fas fa-users"></i> Agregar </a></td>
                                    </tr>
                                    @endif

                                    @if (count($evatipodocentes) > 0 )
                                    <tr>
                                        <td>1</td>
                                        <td>Evaluador interno - Docentes/Directivos</td>
                                        <td><a href="{{ route('admin.ver.evaluacion', [$iniciativa[0]->inic_codigo, 1]) }}"
                                            class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                             <i class="fas fa-eye"></i> Ver resultados de la evaluación </a></td>
                                        <td><a href="{{ route('admin.iniciativa.evaluar.invitar', [$iniciativa[0]->inic_codigo, 1]) }}"
                                            class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                             <i class="fas fa-users"></i> Agregar </a></td>
                                    </tr>
                                    @endif

                                    @if (count($evatipoexternos) > 0)
                                    <tr>
                                        <td>2</td>
                                        <td>Evaluador externo</td>
                                        <td><a href="{{ route('admin.ver.evaluacion', [$iniciativa[0]->inic_codigo, 2]) }}"
                                            class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                             <i class="fas fa-eye"></i> Ver resultados de la evaluación </a></td>
                                        <td><a href="{{ route('admin.iniciativa.evaluar.invitar', [$iniciativa[0]->inic_codigo, 2]) }}"
                                            class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                             <i class="fas fa-users"></i> Agregar </a></td>
                                    </tr>
                                    @endif




                                </tbody>
                            </table>
                        </div>
                        @endif




















                        </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function cambioTipo() {
                var tipo = document.getElementById('tipo').value;
                document.getElementById('invitado_rol').value = document.getElementById('tipo').value;

                if (tipo == 0) {
                    document.getElementById('botonesdeAbajo').style.display = 'block';
                    document.getElementById('EstudiantesBloque').style.display = 'block';
                    document.getElementById('DocentesBloque').style.display = 'none';
                    document.getElementById('ExternosBloque').style.display = 'none';
                } else if (tipo == 1) {
                    document.getElementById('EstudiantesBloque').style.display = 'none';
                    document.getElementById('botonesdeAbajo').style.display = 'block';
                    document.getElementById('DocentesBloque').style.display = 'block';
                    document.getElementById('ExternosBloque').style.display = 'none';
                } else if (tipo == 2) {
                    document.getElementById('EstudiantesBloque').style.display = 'none';
                    document.getElementById('botonesdeAbajo').style.display = 'block';
                    document.getElementById('DocentesBloque').style.display = 'none';
                    document.getElementById('ExternosBloque').style.display = 'block';
                } else{
                    document.getElementById('EstudiantesBloque').style.display = 'none';
                    document.getElementById('botonesdeAbajo').style.display = 'block';
                    document.getElementById('DocentesBloque').style.display = 'none';
                    document.getElementById('ExternosBloque').style.display = 'none';
                }

            }
            function redireccionarEvaluadores() {
                evaluador = document.getElementById('tipo').value;
                if(evaluador == ""){
                    alert('Debe seleccionar un tipo de evaluador');
                    return;
                }
                console.log('inic_codigo: {{$iniciativa[0]->inic_codigo}}' );
                window.location.href = '/admin/iniciativas/'+{{$iniciativa[0]->inic_codigo}}+'/evaluar/invitar/'+evaluador;
            }

            function redireccionarResultados() {
                evaluador = document.getElementById('tipo').value;
                if(evaluador == ""){
                    alert('Debe seleccionar un tipo de evaluador');
                    return;
                }
                console.log('inic_codigo: {{$iniciativa[0]->inic_codigo}}' );
                window.location.href = '/admin/iniciativas/'+{{$iniciativa[0]->inic_codigo}}+'/evaluacion/resultados/'+evaluador;
            }
        </script>

        
@endsection
