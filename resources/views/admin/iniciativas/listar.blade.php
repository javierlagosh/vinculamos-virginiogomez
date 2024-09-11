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
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6">
                            @if (Session::has('exitoIniciativa'))
                                <div class="alert alert-success alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <strong>{{ Session::get('exitoIniciativa') }}</strong>
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-6">
                            @if (Session::has('errorIniciativa'))
                                <div class="alert alert-danger alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <strong>{{ Session::get('errorIniciativa') }}</strong>
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-3"></div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Listado de Actividades</h4>
                            @if (Session::has('admin'))


                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" onclick="obtenerIDs()"><i class="fas fa-tachometer-alt"></i> Almacenar INVI</button>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form action="{{ route($role . '.iniciativa.listar') }}" method="GET">
                                <div class="row align-items-end">
                                    <div class="col-xl-4  col-md-4 col-lg-4 mb-2 mb-sm-0">
                                        <div class="form-group">
                                            <label>Filtrar por Mecanismo</label>
                                            <select class="form-control select2" style="width: 100%" id="mecanismo" name="mecanismo">
                                                <option value="" selected>Seleccione...</option>
                                                <option value="">Todos los mecanismos</option>
                                                @forelse ($mecanismos as $mecanismo)
                                                    <option value="{{ $mecanismo->meca_nombre }}" {{ Request::get('mecanismo') == $mecanismo->meca_nombre ? 'selected' : '' }}>
                                                        {{ $mecanismo->meca_nombre }}
                                                    </option>
                                                @empty
                                                    <option value="-1">No existen registros</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Filtrar por Estado</label>
                                            <select class="form-control select2" style="width: 100%" id="estados" name="estados">
                                                <option value="" selected>Seleccione...</option>
                                                <option value="">Todos los estados</option>
                                                <option value="1" {{ Request::get('estados') == 1 ? 'selected' : '' }}>En revisión</option>
                                                <option value="2" {{ Request::get('estados') == 2 ? 'selected' : '' }}>En ejecución</option>
                                                <option value="3" {{ Request::get('estados') == 3 ? 'selected' : '' }}>Aceptada</option>
                                                <option value="4" {{ Request::get('estados') == 4 ? 'selected' : '' }}>Falta info</option>
                                                <option value="5" {{ Request::get('estados') == 5 ? 'selected' : '' }}>Cerrada</option>
                                                <option value="6" {{ Request::get('estados') == 6 ? 'selected' : '' }}>Finalizada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4  col-md-4 col-lg-4 mb-2 mb-sm-0">
                                        <div class="form-group">
                                            <label>Filtrar por Año</label>
                                            <select class="form-control select2" style="width: 100%" id="anho" name="anho">
                                                <option value="" selected>Seleccione...</option>
                                                <option value="todos">Todos los años</option>
                                                @forelse ($anhos as $ann)
                                                    <option value="{{ $ann->inic_anho }}" {{ Request::get('anho') == $ann->inic_anho ? 'selected' : '' }}>
                                                        {{ $ann->inic_anho }}
                                                    </option>
                                                @empty
                                                    <option value="-1">No existen registros</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="mb-4 text-right">
                                            <button type="submit" class="btn btn-primary mr-1 waves-effect"><i class="fas fa-search"></i> Filtrar</button>
                                            <a href="{{ route($role . '.iniciativa.listar') }}" type="button" class="btn btn-primary mr-1 waves-effect"><i class="fas fa-broom"></i> Limpiar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Mecanismo</th>
                                            <th>Año</th>
                                            <th>Sedes</th>
                                            <th>Escuelas</th>
                                            <th>Estado</th>
                                            <th>Fecha de creación</th>
                                            <th style="width: 250px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-iniciativas">
                                        @php $num = 1; @endphp
                                        @foreach ($iniciativas as $iniciativa)
                                            <tr>
                                                <td>{{ $num++ }}</td>
                                                <td>{{ $iniciativa->inic_nombre }}</td>
                                                <td>{{ $iniciativa->meca_nombre }}</td>
                                                <td>{{ $iniciativa->inic_anho }}</td>
                                                <td>
                                                    @php $sedesArray = explode(',', $iniciativa->sedes); @endphp
                                                    @if (count($sedesArray) > 3)
                                                        Todas
                                                    @else
                                                        {{ $iniciativa->sedes }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @php $carrerasArray = explode(',', $iniciativa->carreras); @endphp
                                                    @if (count($carrerasArray) > 29)
                                                        Todas
                                                    @else
                                                        {{ $iniciativa->carreras }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $estadoBadges = [
                                                            1 => ['class' => 'light', 'icon' => 'history', 'text' => 'En revisión'],
                                                            2 => ['class' => 'info', 'icon' => 'play-circle', 'text' => 'En ejecución'],
                                                            3 => ['class' => 'success', 'icon' => 'lock', 'text' => 'Aprobada'],
                                                            4 => ['class' => 'info', 'icon' => 'info-circle', 'text' => 'Falta info'],
                                                            5 => ['class' => 'primary', 'icon' => 'pause-circle', 'text' => 'Cerrada'],
                                                            6 => ['class' => 'success', 'icon' => 'check-double', 'text' => 'Finalizada'],
                                                        ];
                                                    @endphp
                                                    <div class="badge badge-{{ $estadoBadges[$iniciativa->inic_estado]['class'] }} badge-shadow">
                                                        <i class="fas fa-{{ $estadoBadges[$iniciativa->inic_estado]['icon'] }}"></i> {{ $estadoBadges[$iniciativa->inic_estado]['text'] }}
                                                    </div>
                                                </td>
                                                <td>{{ $iniciativa->inic_creado }}</td>
                                                <td>
                                                    <div class="dropdown d-inline">
                                                        <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" title="Opciones">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropright">
                                                            @if (!Session::has('observador'))
                                                            <a href="{{ route($role . '.editar.paso1', $iniciativa->inic_codigo) }}" class="dropdown-item has-icon"><i class="fas fa-edit"></i>Editar actividad</a>
                                                            @endif
                                                            <a href="{{ route($role . '.iniciativas.detalles', $iniciativa->inic_codigo) }}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ver detalles"><i class="fas fa-eye"></i>Mostrar detalles</a>
                                                            <a href="javascript:void(0)" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Calcular INVI" onclick="calcularIndice({{ $iniciativa->inic_codigo }})"><i class="fas fa-tachometer-alt"></i> Calcular INVI</a>
                                                            @if (Session::has('admin'))
                                                            <a href="javascript:void(0)" class="dropdown-item has-icon" onclick="eliminarIniciativa({{ $iniciativa->inic_codigo }})" data-toggle="tooltip" data-placement="top" title="Eliminar">Eliminar actividad<i class="fas fa-trash"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if (!Session::has('observador'))
                                                    
                                                    <div class="dropdown d-inline">
                                                        <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" title="ingresar">
                                                            <i class="fas fa-plus-circle"></i> Ingresar
                                                        </button>
                                                        <div class="dropdown-menu dropright">
                                                            <a href="{{ route($role . '.cobertura.index', $iniciativa->inic_codigo) }}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ingresar cobertura"><i class="fas fa-users"></i> Ingresar cobertura</a>
                                                            <a href="{{ route($role . '.ver.lista.de.resultados', $iniciativa->inic_codigo) }}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ingresar resultado"><i class="fas fa-flag"></i> Ingresar resultados</a>
                                                            <a href="{{ route($role . '.evidencias.listar', $iniciativa->inic_codigo) }}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Adjuntar evidencia"><i class="fas fa-paperclip"></i>Adjuntar evidencia</a>
                                                            {{-- <a href="{{ route($role . '.evaluar.iniciativa', $iniciativa->inic_codigo) }}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Evaluar iniciativa"><i class="fas fa-file-signature"></i> Evaluar iniciativa</a> --}}
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if (!Session::has('observador'))
                                                    <div class="dropdown d-inline">
                                                        <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown">Estados</button>
                                                        <div class="dropdown-menu dropright">
                                                            <form method="POST" action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                                                @csrf
                                                                <input type="hidden" name="state" value="3">
                                                                <a href="javascript:void(0);" onclick="this.closest('form').submit();" class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                                    <i class="fas fa-check" style="margin-right: 8px;"></i> Aprobar actividad
                                                                </a>
                                                            </form>
                                                            <form method="POST" action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                                                @csrf
                                                                <input type="hidden" name="state" value="2">
                                                                <a href="javascript:void(0);" onclick="this.closest('form').submit();" class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                                    <i class="fas fa-cog" style="margin-right: 8px;"></i> En ejecución
                                                                </a>
                                                            </form>
                                                            <form method="POST" action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                                                @csrf
                                                                <input type="hidden" name="state" value="4">
                                                                <a href="javascript:void(0);" onclick="this.closest('form').submit();" class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                                    <i class="fas fa-info-circle" style="margin-right: 8px;"></i> Falta información
                                                                </a>
                                                            </form>
                                                            <form method="POST" action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                                                @csrf
                                                                <input type="hidden" name="state" value="5">
                                                                <a href="javascript:void(0);" onclick="this.closest('form').submit();" class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                                    <i class="fas fa-lock" style="margin-right: 8px;"></i> Cerrar actividad
                                                                </a>
                                                            </form>
                                                            <form method="POST" action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                                                @csrf
                                                                <input type="hidden" name="state" value="6">
                                                                <a href="javascript:void(0);" onclick="this.closest('form').submit();" class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                                    <i class="fas fa-check-double" style="margin-right: 8px;"></i> Finalizar actividad
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
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
        </div>
    </section>
    <div class="modal fade" id="modalEliminaIniciativa" tabindex="-1" role="dialog" aria-labelledby="modalEliminar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route($role . '.iniciativa.eliminar') }} " method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminar">Eliminar Iniciativa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-ban text-danger" style="font-size: 50px; color"></i>
                        <h6 class="mt-2">La iniciativa dejará de existir dentro del sistema. <br> ¿Desea continuar de
                            todos
                            modos?</h6>
                        <input type="hidden" id="inic_codigo" name="inic_codigo" value="">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalINVI" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Índice de vinculación INVI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="invi_modal_guardado"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-md" id="table-1"
                        style="border-top: 1px ghostwhite solid;">
                        <tbody>
                            <tr style="display: none;">
                                <td id='codigo_iniciativa'></td>
                            </tr>
                            <tr>
                                <td><strong>Mecanismo</strong></td>
                                <td id="mecanismo-nombre"></td>
                                <td id="mecanismo-puntaje"></td>
                            </tr>
                            <tr>
                                <td><strong>Frecuencia</strong></td>
                                <td id="frecuencia-nombre"></td>
                                <td id="frecuencia-puntaje"></td>
                            </tr>
                            <tr>
                                <td><strong>Resultados</strong></td>
                                <td id="resultados-nombre"></td>
                                <td id="resultados-puntaje"></td>
                            </tr>
                            <tr>
                                <td><strong>Cobertura</strong></td>
                                <td id="cobertura-nombre"></td>
                                <td id="cobertura-puntaje"></td>
                            </tr>
                            <tr>
                                <td><strong>Evaluación</strong></td>
                                <td id="evaluacion-nombre"></td>
                                <td id="evaluacion-puntaje"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6>Índice de vinculación INVI</h6>
                                </td>
                                <td id="valor-indice"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    @if (!Session::has('observador'))
                    <button type="button" class="btn btn-primary" onclick="guardarINVI()"> <i class="fas fa-save"></i> Guardar</button>
                    @endif
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="{{ asset('/js/admin/iniciativas/INVI.js') }}"></script>
    <script>
        function eliminarIniciativa(inic_codigo) {
            $('#inic_codigo').val(inic_codigo);
            $('#modalEliminaIniciativa').modal('show');
        }
    </script>
@endsection
