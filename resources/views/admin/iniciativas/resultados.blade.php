@if (Session::has('admin'))
    @php
        $role = 'admin';
    @endphp
@elseif (Session::has('digitador'))
    @php
        $role = 'admin';
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
                <div class="col-12">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            @if (Session::has('exitoExterno'))
                                <div class="alert alert-success alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <strong>{{ Session::get('exitoExterno') }}</strong>
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3"></div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $iniciativa->inic_nombre }} - Registro de resultados finales</h4>
                            <div class="card-header-action">
                                <div class="dropdown d-inline">
                                    <button class="btn btn-info dropdown-toggle" id="dropdownMenuButton2"
                                        data-toggle="dropdown">Actividades</button>
                                    <div class="dropdown-menu dropright">
                                        <a href="{{ route('admin.iniciativas.detalles', $iniciativa->inic_codigo) }}"
                                            class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                            title="Editar actividad"><i class="fas fa-eye"></i> Mostrar
                                            actividad</a>

                                    </div>
                                </div>

                                <div class="dropdown d-inline">
                                    <button class="btn btn-success dropdown-toggle" id="dropdownMenuButton2"
                                        data-toggle="dropdown" title="ingresar"><i class="fas fa-plus-circle"></i>
                                        Ingresar</button>
                                    <div class="dropdown-menu dropright">
                                        <a href="{{ route('admin.cobertura.index', $iniciativa->inic_codigo) }}"
                                            class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top"
                                            title="Ingresar cobertura"><i class="fas fa-users"></i> Ingresar cobertura</a>
                                            <a href="{{ route('admin.ver.lista.de.resultados', $iniciativa->inic_codigo) }}"
                                                class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top"
                                                title="Ingresar resultado"><i class="fas fa-flag"></i>Ingresar resultado/s</a>
                                            <a href="{{ route('admin.evidencias.listar', $iniciativa->inic_codigo) }}"
                                                class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                                title="Adjuntar evidencia"><i class="fas fa-paperclip"></i> Ingresar
                                                evidencias</a>
                                                <a href="{{ route('admin.evaluar.iniciativa', $iniciativa->inic_codigo) }}"
                                                    class="dropdown-item has-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Ingresar evaluación"><i
                                                        class="fas fa-file-signature"></i> Ingresar evaluación</a>
                                    </div>
                                </div>


                                <a href="{{ route('admin.iniciativa.listar') }}"
                                    class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                    <i class="fas fa-angle-left"></i> Volver a listado
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <form action="" method="post"> --}}
                            <form action="{{ route($role . '.resultados.actualizar', $iniciativa->inic_codigo) }}"
                                method="post">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-2"></div>
                                    <div class="col-8">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-md">
                                                        <thead>
                                                            <tr>
                                                                <th>Resultado esperado</th>
                                                                <th>Cantidad Inicial</th>
                                                                <th>Cantidad Final</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($participantes as $participante)
                                                                <tr>
                                                                    <td>{{ $participante->resu_nombre }}</td>
                                                                    <td>
                                                                        @if ($participante->resu_cuantificacion_inicial > 0)
                                                                            {{ $participante->resu_cuantificacion_inicial }}
                                                                        @else
                                                                            No registrado.
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <input type="number"
                                                                            name="resultados[{{ $participante->resu_codigo }}]"
                                                                            class="form-control"
                                                                            value="{{ $participante->resu_cuantificacion_final }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12 text-right">
                                        <input type="hidden" id="inic_codigo" name="inic_codigo"
                                            value="{{ $iniciativa->inic_codigo }}">
                                        <a href="{{ route($role . '.iniciativa.listar') }}"
                                            class="btn btn-primary mr-1 waves-effect" type="button">
                                            <i class="fas fa-angle-left"></i> Volver a listado
                                        </a>
                                        <button type="submit" class="btn btn-primary mr-1 waves-effect"><i
                                                class="fas fa-save"></i> Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
