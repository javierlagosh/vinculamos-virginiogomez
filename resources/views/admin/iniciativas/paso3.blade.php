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
    <section class="section">
        <div class="section-body">

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    @if (Session::has('exitoPaso2'))
                        <div class="alert alert-success alert-dismissible show fade mb-4 text-center">
                            <div class="alert-body">
                                <strong>{{ Session::get('exitoPaso2') }}</strong>
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        </div>
                    @endif

                    @if (Session::has('errorPaso3'))
                        <div class="alert alert-danger alert-dismissible show fade mb-4 text-center">
                            <div class="alert-body">
                                <strong>{{ Session::get('errorPaso3') }}</strong>
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if (false)
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="alert alert-danger alert-dismissible show fade mb-4 text-center">
                            <div class="alert-body">
                                <strong>Ocurrió un error al recuperar información de la iniciativa registrada.</strong>
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 alert-container" id="exito_ingresar" style="display: none;">
                        <div class="alert alert-success show fade mb-4 text-center">
                            <div class="alert-body">
                                <strong>Datos guardados correctamente</strong>
                                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $iniciativa->inic_nombre }} - Paso 3 de 3</h4>
                        <div class="card-header-action">
                            <div class="dropdown d-inline">
                                <button class="btn btn-info dropdown-toggle" id="dropdownMenuButton2"
                                    data-toggle="dropdown">Iniciativas</button>
                                <div class="dropdown-menu dropright">
                                    <a href="{{ route('admin.iniciativas.detalles', $iniciativa->inic_codigo) }}"
                                        class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top"
                                        title="Ver detalles de la iniciativa"><i class="fas fa-eye"></i>Ver
                                        detalle</a>

                                    <a href="{{ route('admin.evidencias.listar', $iniciativa->inic_codigo) }}"
                                        class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top"
                                        title="Adjuntar evidencia"><i class="fas fa-paperclip"></i>Evidencias</a>
                                </div>



                            </div>

                            <div class="dropdown d-inline">
                                <button class="btn btn-success dropdown-toggle" id="dropdownMenuButton2"
                                    data-toggle="dropdown" title="ingresar"><i class="fas fa-plus-circle"></i>
                                    Ingresar</button>
                                <div class="dropdown-menu dropright">
                                    <a href="{{ route('admin.cobertura.index', $iniciativa->inic_codigo) }}"
                                        class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top"
                                        title="Ingresar cobertura"><i class="fas fa-users"></i> Ingresar
                                        cobertura</a>

                                    <a href="{{ route($role . '.ver.lista.de.resultados', $iniciativa->inic_codigo) }}"
                                        class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top"
                                        title="Ingresar resultado"><i class="fas fa-flag"></i> Ingresar
                                        resultado/s</a>
                                </div>
                            </div>

                            <a href="{{ route('admin.iniciativa.listar') }}"
                                class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                <i class="fas fa-angle-left"></i> Volver a listado
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6>Recursos</h6>
                        <div class="row mt-3">
                            <div class="col-3 col-md-3 col-lg-3"></div>
                            <div class="col-6 col-md-6 col-lg-6 text-center" id="div-alert-recursos"></div>
                            <div class="col-3 col-md-3 col-lg-3"></div>
                            <input type="hidden" id="codigo" name="codigo" value="{{ $iniciativa->inic_codigo }}">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md ">
                                    <tr>
                                        <th></th>
                                        <th class="text-center">
                                            <h6>Dinero</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Infraestructura</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Recursos Humanos</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Total</h6>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class=""><strong>
                                                <h6>Aportado por la institución</h6>
                                            </strong></td>
                                        <td>
                                            <div class="row mb-2">
                                                <div class="col-12 col-md-12 col-lg-12 text-center" id="empresadinero">

                                                </div>
                                            </div>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="number" class="form-control" id="aporteempresa"
                                                                name="aporteempresa" autocomplete="off"
                                                                oninput="checkNumber('aporteempresa')" min="0">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="select2" style="width: 90%"
                                                                name="centroInterno" id="centroInterno">
                                                                <option value="" selected disabled>Seleccione...
                                                                </option>
                                                                @foreach ($centroCostos as $ceco)
                                                                    <option value="{{ $ceco->ceco_codigo }}">
                                                                        {{ $ceco->ceco_nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="mt-2 text-center">

                                                                <button type="button" class="btn btn-icon btn-primary"
                                                                    onclick="guardarDinero(1)">
                                                                    <i id="dinero-empresa-cero" class="fas fa-save"></i>
                                                                </button>

                                                                <button id="dinero-empresa-limpiar" type="button"
                                                                    class="btn btn-icon btn-danger"
                                                                    onclick="guardarDinero(1,true)">
                                                                    <i class="fas fa-times"></i>
                                                                </button>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-9 col-md-9 col-lg-9 mt-2 text-center"
                                                    id="empresa-infra-total">

                                                </div>
                                                <div class="col-3 col-md-3 col-lg-3">
                                                    <button type="button" class="btn btn-icon btn-primary"
                                                        onclick="crearInfra(1)"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mr-1 ml-1">
                                                <table class="table table-bordered table-hover  table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Recurso</th>
                                                            <th>Horas</th>
                                                            <th>Cantidad</th>
                                                            <th>Valorización</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-empresa-infra">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-9 col-md-9 col-lg-9 mt-2 text-center"
                                                    id="empresa-rrhh-total">

                                                </div>
                                                <div class="col-3 col-md-3 col-lg-3">
                                                    <button type="button" class="btn btn-icon btn-primary"
                                                        onclick="crearRrhh(1)"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mr-1 ml-1">
                                                <table class="table table-bordered table-hover  table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Recurso</th>
                                                            <th>Horas</th>
                                                            <th>Cantidad</th>
                                                            <th>Valorización</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-empresa-rrhh">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="col-12 col-md-12 col-lg-12" id="empresa-total">

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>
                                                <h6>Aportado por externos</h6>
                                            </strong></td>
                                        <td>
                                            <div class="row mb-2">
                                                <div class="col-12 col-md-12 col-lg-12 text-center" id="externodinero">
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="number" class="form-control"
                                                                    id="aporteexterno" name="aporteexterno"
                                                                    oninput="checkNumber('aporteexterno')" min="0"
                                                                    style="display: inline-block; margin-right: 5px;"
                                                                    autocomplete="off"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="select2" style="width: 100%"
                                                                    name="centroExterno" id="centroExterno">
                                                                    <option value="" selected disabled>Seleccione
                                                                        centro de costos...
                                                                    </option>
                                                                    @foreach ($centroCostos as $ceco)
                                                                        <option value="{{ $ceco->ceco_codigo }}">
                                                                            {{ $ceco->ceco_nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="mt-2 text-center">
                                                                    <button type="button"
                                                                        class="btn btn-icon btn-primary"
                                                                        onclick="guardarDinero(2)">
                                                                        <i id="dineceroro-externo-"
                                                                            class="fas fa-save"></i>

                                                                    </button>
                                                                    <button id="dinero-externo-limpiar" type="button"
                                                                        class="btn btn-icon btn-danger"
                                                                        onclick="guardarDinero(2,true)">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-9 col-md-9 col-lg-9 mt-2 text-center"
                                                    id="externo-infra-total">

                                                </div>
                                                <div class="col-3 col-md-3 col-lg-3">
                                                    <button type="button" class="btn btn-icon btn-primary"
                                                        onclick="crearInfra(2)"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mr-1 ml-1">
                                                <table class="table table-bordered table-hover  table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Recurso</th>
                                                            <th>Cantidad</th>
                                                            <th>Horas</th>
                                                            <th>Valorización</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-externo-infra">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-9 col-md-9 col-lg-9 mt-2 text-center"
                                                    id="externo-rrhh-total">

                                                </div>
                                                <div class="col-3 col-md-3 col-lg-3">
                                                    <button type="button" class="btn btn-icon btn-primary"
                                                        onclick="crearRrhh(2)"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mr-1 ml-1">
                                                <table class="table table-bordered table-hover  table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Recurso</th>
                                                            <th>Horas</th>
                                                            <th>Cantidad</th>
                                                            <th>Valorización</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-externo-rrhh">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="col-12 col-md-12 col-lg-12" id="externo-total">

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="text-right">
                                    <a href="{{ route($role . '.editar.paso2', $iniciativa->inic_codigo) }}"
                                        type="button" class="btn btn-primary mr-1 waves-effect"><i
                                            class="fas fa-chevron-left"></i> Volver al paso anterior</a>
                                    <button type="button" class="btn btn-primary mr-1 waves-effect" data-toggle="modal"
                                        data-target="#modalFinalizar"><i class="fas fa-check"></i> Finalizar</button>
                                    <a href="{{ route($role . '.editar.paso3', $iniciativa->inic_codigo) }}"
                                        type="button" class="btn btn-warning waves-effect">Recargar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        </div>
    </section>

    <div class="modal fade" id="modalInfraestructura" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Agregar infraestructura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center" id="div-alert-infraestructura">
                        </div>
                        <div class="form-group">
                            <label>Tipo infraestructura y equipamiento</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                                <select class="form-control" id="codigoinfra" name="codigoinfra"
                                    onchange="buscarTipoInfra()">
                                    <option value="" selected disabled>Seleccione...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Centro de costos</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-bank"></i>
                                    </div>
                                </div>
                                <select class="select2" style="width: 90%" name="centroCostos" id="centroCostos">
                                    <option value="" selected disabled>Seleccione...</option>
                                    @foreach ($centroCostos as $ceco)
                                        <option value="{{ $ceco->ceco_codigo }}">{{ $ceco->ceco_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Horas de uso</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-stopwatch"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" id="horasinfra" name="horasinfra"
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cantidad de Infraestructuras</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-home"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" id="cantidadinfra" name="cantidadinfra"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Valorización</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" id="valorinfra" name="valorinfra" disabled>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" id="entidadinfra" name="entidadinfra">
                            <input type="hidden" id="valorinfra" name="valorinfra">
                            <button type="button" class="btn btn-primary waves-effect"
                                onclick="guardarInfra()">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRrhh" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Agregar RRHH</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-6">
                                <form>
                                    <div class="text-center" id="div-alert-rrhh">
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo RRHH</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" id="codigorrhh" name="codigorrhh"
                                                onchange="buscarTipoRrhh()">
                                                <option value="" selected disabled>Seleccione...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Centro de costos</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-bank"></i>
                                                </div>
                                            </div>
                                            <select class="select2" style="width: 85%" name="centroRrhh"
                                                id="centroRrhh">
                                                <option value="" selected disabled>Seleccione...</option>
                                                @foreach ($centroCostos as $ceco)
                                                    <option value="{{ $ceco->ceco_codigo }}">{{ $ceco->ceco_nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Cantidad de horas</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-stopwatch"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" id="horasrrhh" name="horasrrhh"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Cantidad de personal</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" id="cantidadhh" name="cantidadhh"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Valorización</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" id="valorrrhh" name="valorrrhh"
                                                disabled>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="col-xl-6">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Resumen de RRHH estimados</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total de estudiantes contemplados:</td>
                                                <td>{{ $estudiantes != null ? $estudiantes : 'Sin registrar' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total de docentes contemplados:</td>
                                                <td>{{ $docentes != null ? $docentes : 'Sin registrar' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total de funcionarios contemplados:</td>
                                                <td>{{ $funcionarios != null ? $funcionarios : 'Sin registrar' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="text-center">
                                    <input type="hidden" id="entidadrrhh" name="entidadrrhh">
                                    <input type="hidden" id="valorrrhh" name="valorrrhh">
                                    <button type="button" class="btn btn-primary waves-effect"
                                        onclick="guardarRrhh()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="tituloModalFinalizar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalFinalizar">Registro de iniciativa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 50px; color"></i>
                    <h6 class="mt-2">Todos los datos de la iniciativa han sido ingresados con éxito.</h6>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <a href="{{ route($role . '.iniciativa.listar') }}" type="button" class="btn btn-primary">Continuar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ '/js/admin/iniciativas/paso3.js' }}"></script>
    <script>
        function MostrarIngreso() {
            var alerta = document.getElementById("exito_ingresar");
            alerta.style.display = "block";
            setTimeout(function() {
                alerta.style.display = "none";
            }, 3000);
        }
    </script>
@endsection
