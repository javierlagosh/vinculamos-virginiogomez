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
                            <div class="row align-items-end">
                                <div class="col-xl-3 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="sede">Sedes</label>
                                        <select
                                            name="sede" id="sede"
                                            class="form-control select2"
                                            style="width: 100%">
                                            <option value=""  selected>Seleccione...</option>
                                            <option value="all">Todas</option>
                                            @forelse ($sedes as $sede)
                                                <option value="{{ $sede->sede_codigo }}"
                                                    {{ Request::get('sede') == $sede->sede_codigo ? 'selected' : '' }}>
                                                    {{ $sede->sede_nombre }}</option>
                                            @empty
                                                <option value="-1">No existen registros</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-3  col-md-3 col-lg-3 mb-2 mb-sm-0">
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
                                <div class="col-xl-3 col-md-3 col-lg-3">
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
                                <div class="col-xl-3  col-md-3 col-lg-3 mb-2 mb-sm-0">
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
                            </div>

                            <div class="row">
                                <div class="col-8">
                                    <input
                                        type="text"
                                        class="form-control mb-0"
                                        name="search"
                                        placeholder="Buscar actividades..."
                                        value="{{ request()->input('search') }}">
                                </div>
                                <div class="col-4">
                                <button
                                    class="btn btn-primary waves-effect text-white float-right"
                                    id="btnLimpiar">
                                    <i class="fas fa-broom"></i> Limpiar
                                </button>
                                </div>
                            </div>
                            
                            <div id="iniciativas-container">
                                <div class="table-responsive">
                                    <table class="table table-striped w-100" id="iniciativas">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%" data-column="inic_codigo">#</th>
                                                <th data-column="inic_nombre">Nombre</th>
                                                <th data-column="meca_nombre">Mecanismo</th>
                                                <th style="width: 5%" data-column="inic_anho">Año</th>
                                                <th data-column="sedes">Sedes</th>
                                                <th data-column="tiac_nombre">Unidades</th>
                                                <th data-column="inic_estado">Estado</th>
                                                <th data-column="inic_creado">Fecha de creación</th>
                                                <th style="width: 24%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla-iniciativas">
                                        </tbody>
                                    </table>
                                </div>
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

    <div class="modal fade" id="modalUpdateState" tabindex="-1" role="dialog" aria-labelledby="modalUpdateState"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.iniciativas.updateState') }} " method="POST">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUpdateEstado">Actualizar estado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-refresh text-success mb-3" style="font-size: 50px; color"></i>
                        <h6 class="mt-2" id="mensajeUpdateState"></h6>
                        <input type="hidden" id="inic_codigo_update" name="inic_codigo" value="">
                        <input type="hidden" id="estado_update" name="state" value="">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalINVI" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
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
    <link rel="stylesheet" href="{{ asset('/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/admin/iniciativas/INVI.js') }}"></script>
    <script>
        const evaluaRuta = '{{ route("admin.evaluar.iniciativa", ":codigo") }}';

        var table = $('#iniciativas').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ajax: {
                url: '{{ route('admin.iniciativa.listar') }}',
                type: 'GET',
                data: function (d) {
                    d.search = $('input[name="search"]').val();
                    d.sede = $('select[name="sede"]').val();
                    d.mecanismo = $('select[name="mecanismo"]').val();
                    d.estados = $('select[name="estados"]').val();
                    d.anho = $('select[name="anho"]').val();
                }
            },
            columns: [
                { data: 'inic_codigo', name: 'iniciativas.inic_codigo' },
                { data: 'inic_nombre', name: 'iniciativas.inic_nombre' },
                { data: 'meca_nombre', name: 'mecanismos.meca_nombre' },
                { data: 'inic_anho', name: 'iniciativas.inic_anho' },
                {
                    data: 'sedes',
                    name: 'sedes',
                    render: function(data, type, row) {
                        if(data === null){
                            return "";
                        }

                        const sedesArray = data.split(' / ');
                        if (sedesArray.length > 6) {
                            return 'Todas';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'carreras',
                    name: 'carreras',
                    render: function(data, type, row) {
                        if(data === null){
                            return "";
                        }

                        const carrerasArray = data.split(' / ');
                        if (carrerasArray.length > 6) {
                            return 'Todas';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'inic_estado',
                    name: 'iniciativas.inic_estado',
                    render: function(data, type, row) {
                        const estadoBadges = {
                            1: { class: 'light', icon: 'history', text: 'En revisión' },
                            2: { class: 'info', icon: 'play-circle', text: 'En ejecución' },
                            3: { class: 'success', icon: 'lock', text: 'Aprobada' },
                            4: { class: 'info', icon: 'info-circle', text: 'Falta info' },
                            5: { class: 'primary', icon: 'pause-circle', text: 'Cerrada' },
                            6: { class: 'success', icon: 'check-double', text: 'Finalizada' },
                        };
                        const badge = estadoBadges[data];

                        if (badge) {
                            return `<div class="badge badge-${badge.class} badge-shadow">
                                        <i class="fas fa-${badge.icon}"></i>
                                        ${badge.text}
                                    </div>`;
                        } else {
                            return data; // En caso de que el estado no esté definido, devuelve el valor tal cual
                        }
                    }
                },
                { data: 'inic_creado', name: 'iniciativas.inic_creado' },
                {
                    data: null,
                    name: 'acciones',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var editUrl = '{{ route('admin.editar.paso1', ':codigo') }}'.replace(':codigo', row.inic_codigo);
                        var deleteUrl = `javascript:void(0)`;
                        var detailsUrl = '{{ route('admin.iniciativas.detalles', ':codigo') }}'.replace(':codigo', row.inic_codigo);
                        var calcularUrl = `javascript:void(0)`;
                        var coberturaUrl = '{{ route('admin.cobertura.index', ':codigo') }}'.replace(':codigo', row.inic_codigo);
                        var resultadosUrl = '{{ route('admin.ver.lista.de.resultados', ':codigo') }}'.replace(':codigo', row.inic_codigo);
                        var evidenciasUrl = '{{ route('admin.evidencias.listar', ':codigo') }}'.replace(':codigo', row.inic_codigo);
                        var evaluarUrl = evaluaRuta .replace(':codigo', row.inic_codigo);
                        console.log(evaluarUrl);

                        return `<div class="dropdown d-inline">
                                    <button class="btn btn-primary dropdown-toggle btn-sm"
                                        id="dropdownMenuButton2" data-toggle="dropdown" title="Opciones">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropright">
                                        <a href="${editUrl}" class="dropdown-item has-icon">
                                            <i class="fas fa-edit"></i> Editar Actividad
                                        </a>
                                        @if (Session::has('admin'))
                                        <a href="${deleteUrl}" class="dropdown-item has-icon" onclick="eliminarIniciativa(${row.inic_codigo})" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            Eliminar Actividad <i class="fas fa-trash"></i>
                                        </a>
                                        @endif
                                        <a href="${detailsUrl}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ver detalles">
                                            <i class="fas fa-eye"></i> Mostrar detalles
                                        </a>
                                        <a href="${calcularUrl}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Calcular INVI" onclick="calcularIndice(${row.inic_codigo})">
                                            <i class="fas fa-tachometer-alt"></i> Calcular INVI
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-primary dropdown-toggle btn-sm"
                                        id="dropdownMenuButton2" data-toggle="dropdown" title="Ingresar">
                                        <i class="fas fa-plus-circle"></i> Ingresar
                                    </button>
                                    <div class="dropdown-menu dropright">
                                        <a href="${coberturaUrl}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ingresar cobertura">
                                            <i class="fas fa-users"></i> Ingresar cobertura
                                        </a>
                                        <a href="${resultadosUrl}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ingresar resultado">
                                            <i class="fas fa-flag"></i> Ingresar resultados
                                        </a>
                                        <a href="${evidenciasUrl}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ingresar evidencia">
                                            <i class="fas fa-paperclip"></i> Ingresar evidencia
                                        </a>
                                        <a href="${evaluarUrl}" class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top" title="Ingresar evaluación">
                                            <i class="fas fa-file-signature"></i> Ingresar evaluación
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-primary dropdown-toggle btn-sm"
                                        id="dropdownMenuButton2" data-toggle="dropdown" title="Estados">
                                        Estados
                                    </button>
                                    <div class="dropdown-menu dropright">

                                        <a href="javascript:void(0)" class="dropdown-item has-icon" onclick="abrirModalUpdateState(${row.inic_codigo}, 3)" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            Aprobar Iniciativa <i class="fas fa-check"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item has-icon" onclick="abrirModalUpdateState(${row.inic_codigo}, 2)" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            En ejecución <i class="fas fa-cog"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item has-icon" onclick="abrirModalUpdateState(${row.inic_codigo}, 4)" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            Falta información <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item has-icon" onclick="abrirModalUpdateState(${row.inic_codigo}, 5)" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            Cerrar iniciativa <i class="fas fa-lock"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item has-icon" onclick="abrirModalUpdateState(${row.inic_codigo}, 6)" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            Finalizar Iniciativa <i class="fas fa-check-double"></i>
                                        </a>
                                    </div>
                                </div>
                                `;
                    }
                },
            ],
            order: [[0, 'asc']] // Ordenar por la primera columna por defecto
        });

        $(document).on('keyup', 'input[name="search"]', function() {
            table.draw();
        });

        $(document).ready(function(){
            $(document).on('change', 'select[name="sede"], select[name="mecanismo"], select[name="estados"], select[name="anho"]', function() {
                table.draw();  //Refresca la tabla con los nuevos datos
            });

            $(document).on('click', '#btnLimpiar', function(){
                $('select[name="sede"]').val('').trigger('change');
                $('select[name="mecanismo"]').val('').trigger('change');
                $('select[name="estados"]').val('').trigger('change');
                $('select[name="anho"]').val('').trigger('change');
                $('input[name="search"]').val("");
                table.draw();
            });
        });

        function eliminarIniciativa(inic_codigo) {
            $('#inic_codigo').val(inic_codigo);
            $('#modalEliminaIniciativa').modal('show');
        }
        function abrirModalUpdateState(inic_codigo, estado) {
            $('#estado_update').val(estado);
            if(estado == 3){
                $('#mensajeUpdateState').text('¿Está seguro de aprobar la iniciativa?');
            }else if(estado == 2){
                $('#mensajeUpdateState').text('¿Está seguro de poner en ejecución la iniciativa?');
            }else if(estado == 4){
                $('#mensajeUpdateState').text('¿Está seguro de poner en falta de información la iniciativa?');
            }else if(estado == 5){
                $('#mensajeUpdateState').text('¿Está seguro de cerrar la iniciativa?');
            }else if(estado == 6){
                $('#mensajeUpdateState').text('¿Está seguro de finalizar la iniciativa?');
            }
            $('#inic_codigo_update').val(inic_codigo);
            $('#modalUpdateState').modal('show');
        }
        
    </script>
@endsection
