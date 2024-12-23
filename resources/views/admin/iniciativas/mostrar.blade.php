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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row"></div>
                    @if (Session::has('errorIniciativa'))
                    <div class="alert alert-danger alert-dismissible show fade mb-4 text-center">
                        <div class="alert-body">
                            <strong>{{ Session::get('errorIniciativa') }}</strong>
                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    </div>
                @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Información de la actividad</h4>
                            <div class="card-header-action">
                                
                                {{-- <div class="dropdown d-inline">
                                    <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton2"
                                        data-toggle="dropdown">Iniciativa</button>
                                    <div class="dropdown-menu dropright">

                                        <a href="{{ route('admin.cobertura.index', $iniciativa->inic_codigo) }}"
                                            class="dropdown-item has-icon"><i class="fas fa-users"></i>Ingresar
                                            cobertura</a>
                                        <a href="" class="dropdown-item has-icon"><i class="fas fa-flag"></i>Ingresar
                                            resultados</a>
                                        <a href="" class="dropdown-item has-icon"><i
                                                class="fas fa-file-signature"></i>Ingresar evaluación</a>
                                    </div>
                                </div> --}}
                                @if (!Session::has('observador'))
                                <div class="dropdown d-inline">
                                    <button class="btn btn-info dropdown-toggle" id="dropdownMenuButton2"
                                        data-toggle="dropdown">Actividades</button>
                                    <div class="dropdown-menu dropright">
                                        <a href="{{ route('admin.editar.paso1', $iniciativa->inic_codigo) }}"
                                            class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                            title="Editar actividad"><i class="fas fa-edit"></i> Editar
                                            actividad</a>

                                            <a href="{{ route('admin.iniciativas.agendaods', $iniciativa->inic_codigo)}}"
                                                class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                                title="Contribución externa"><i class="fas fa-star-half"></i> Contribución externa</a>
                                            <a href="{{ route('admin.iniciativas.pdf', $iniciativa->inic_codigo)}}"
                                                class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                                title="Generar pdf con ODS"><i class="fas fa-file-pdf"></i> Generar pdf con ODS</a>
                                            <a href="javascript:void(0)" class="dropdown-item has-icon"
                                            data-toggle="tooltip" data-placement="top" title="Calcular INVI"
                                            onclick="calcularIndice({{ $iniciativa->inic_codigo }})"><i
                                                class="fas fa-tachometer-alt"></i> INVI</a>
                                            
                                            {{-- <a href="{{ route('admin.iniciativas.agendaods', $iniciativa->inic_codigo) }}"
                                                class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                                title="Revisar ODS "><i class="fas fa-recycle"></i> Agenda 2030</a>
                                                <a href="{{ route('admin.iniciativas.pdf', $iniciativa->inic_codigo) }}"
                                                    class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                                    title="Generar pdf con ODS "><i class="fas fa-file-pdf"></i> Generar pdf con ODS</a> --}}

                                                    @if (Session::has('admin'))
                                        <a href="javascript:void(0)" class="dropdown-item has-icon" data-toggle="tooltip"
                                            onclick="eliminarIniciativa({{ $iniciativa->inic_codigo }})"
                                            data-placement="top" title="Eliminar actividad"><i class="fas fa-trash"></i> Eliminar actividad</a>
                                            @endif

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
                                            <a href="{{ route('admin.evidencias.listar', $iniciativa->inic_codigo) }}"
                                                class="dropdown-item has-item" data-toggle="tooltip" data-placement="top"
                                                title="Adjuntar evidencia"><i class="fas fa-paperclip"></i> Ingresar
                                                evidencias</a>
                                                <a href="{{ route($role . '.ver.lista.de.resultados', $iniciativa->inic_codigo) }}"
                                                    class="dropdown-item has-icon" data-toggle="tooltip" data-placement="top"
                                                    title="Ingresar resultado"><i class="fas fa-flag"></i> Ingresar resultado/s</a>
                                            <a href="{{ route('admin.evaluar.iniciativa', $iniciativa->inic_codigo) }}"
                                                class="dropdown-item has-icon" data-toggle="tooltip"
                                                data-placement="top" title="Ingresar evaluación"><i
                                                    class="fas fa-file-signature"></i> Evaluar
                                                iniciativa</a>
                                        

                                    </div>
                                </div>

                                <div class="dropdown d-inline">

                                    <button class="btn btn-primary dropdown-toggle" id="dropdownMenuButton2"
                                        data-toggle="dropdown">Estados</button>
                                    <div class="dropdown-menu dropright">
                                        <form method="POST"
                                            action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                            @csrf
                                            <input type="hidden" name="state" value="3">
                                            <a href="javascript:void(0);" onclick="this.closest('form').submit();"
                                                class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                <i class="fas fa-check" style="margin-right: 8px;"></i> Aprobar actividad
                                            </a>
                                        </form>

                                        <form method="POST"
                                            action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                            @csrf
                                            <input type="hidden" name="state" value="2">
                                            <a href="javascript:void(0);" onclick="this.closest('form').submit();"
                                                class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                <i class="fas fa-cog" style="margin-right: 8px;"></i> En ejecución
                                            </a>
                                        </form>

                                        <form method="POST"
                                            action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                            @csrf
                                            <input type="hidden" name="state" value="4">
                                            <a href="javascript:void(0);" onclick="this.closest('form').submit();"
                                                class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                <i class="fas fa-info-circle" style="margin-right: 8px;"></i> Falta
                                                información
                                            </a>
                                        </form>

                                        <form method="POST"
                                            action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                            @csrf
                                            <input type="hidden" name="state" value="5">
                                            <a href="javascript:void(0);" onclick="this.closest('form').submit();"
                                                class="dropdown-item has-icon" style="display: flex; align-items: center;">
                                                <i class="fas fa-lock" style="margin-right: 8px;"></i> Cerrar actividad
                                            </a>
                                        </form>

                                        <form method="POST"
                                            action="{{ route('admin.iniciativas.updateState', ['inic_codigo' => $iniciativa->inic_codigo]) }}">
                                            @csrf
                                            <input type="hidden" name="state" value="6">
                                            <a href="javascript:void(0);" onclick="this.closest('form').submit();"
                                                class="dropdown-item has-icon"
                                                style="display: flex; align-items: center;">
                                                <i class="fas fa-check-double" style="margin-right: 8px;"></i> Finalizar
                                                actividad
                                            </a>
                                        </form>



                                    </div>
                                </div>
                                @endif

                                <a href="{{ route('admin.iniciativa.listar') }}"
                                    class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                    <i class="fas fa-angle-left"></i> Volver a listado
                                </a>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-strip table-md">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>Nombre de la actividad</strong>
                                                </td>
                                                <td>
                                                    {{ $iniciativa->inic_nombre }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <strong>Año</strong>
                                                </td>
                                                <td>
                                                    {{ $iniciativa->inic_anho }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <strong>Fecha de planificación</strong>
                                                </td>
                                                <td>
                                                    {{ $iniciativa->fecha_inicio }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <strong>Fecha de ejecución</strong>
                                                </td>
                                                <td>
                                                    {{ $iniciativa->fecha_ejecucion }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <strong>Fecha de cierre</strong>
                                                </td>
                                                <td>
                                                    {{ $iniciativa->fecha_cierre }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <strong>Descripción</strong>
                                                </td>
                                                <td>
                                                    {{ $iniciativa->inic_descripcion }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Objetivo</strong></td>
                                                <td>{{ $iniciativa->inic_objetivo ?? "No se ha seleccionado un objetivo." }}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>Mecanismo</strong></td>
                                                <td>{{ $iniciativa->meca_nombre }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><strong>Programa</strong></td>
                                                <td>
                                                    @if ($iniciativa->prog_nombre != null)
                                                        {{$iniciativa->prog_nombre}}
                                                    @else
                                                        No especificado
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Tipo de iniciativa</strong></td>
                                                <td>
                                                    {{ $iniciativa->tiac_nombre }}
                                                </td>

                                            </tr>

                                            <tr>
                                                <td><strong>Convenio</strong></td>
                                                <td>{{ $iniciativa->conv_nombre }}</td>
                                            </tr>
                                            <tr>

                                                {{-- {{json_encode($ods_array)}} --}}
                                                @if (count($ods_array) > 0)
                                                    <td><strong>ODS</strong></td>
                                                @else
                                                @endif
                                                <td>
                                                @forelse ($ods_array as $ods)
                                                <!-- Código para mostrar ODS -->
                                                    <img src="https://cftpucv.vinculamos.org/img/ods/{{ $ods->id_ods }}.png" alt="Ods {{ $ods->id_ods }}" style="width: 100px; height: 100px;">
                                                @empty
                                                    
                                                @endforelse
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Ubicaciones</strong></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm">
                                                            <thead>
                                                                <th>Región</th>
                                                                <th>Comunas</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($ubicaciones as $ubicacion)
                                                                    <tr style="background-color: inherit;">
                                                                        <td>{{ $ubicacion->regi_nombre }}</td>
                                                                        <td>{{ $ubicacion->comunas }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Participantes externos</strong></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm ">
                                                            <thead>
                                                                <th>Grupos</th>
                                                                <th>Subgrupos</th>
                                                                <th>Nombre del socio</th>
                                                                <th>Beneficiarios</th>
                                                                <th>Beneficiarios final</th>
                                                            </thead>

                                                            <tbody>
                                                                @foreach ($externos as $externo)
                                                                    <tr>
                                                                        <td>{{ $externo->grin_nombre }}</td>
                                                                        <td>{{ $externo->sugr_nombre }}</td>
                                                                        <td>{{ $externo->soco_nombre_socio }}</td>
                                                                        <td>{{ $externo->inpr_total }}</td>
                                                                        <td>{{ $externo->inpr_total_final }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Participantes internos</strong></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm">
                                                            <thead>
                                                                <th>Sede</th>
                                                                <th>Escuela/Unidad</th>
                                                                <th>Carrera</th>
                                                                <th class="tituloDocentesE">Docentes esperados</th>
                                                                <th class="tituloDocentesR">Docentes reales</th>
                                                                <th class="tituloEstudiantesE">Estudiantes esperados</th>
                                                                <th class="tituloEstudiantesR">Estudiantes reales</th>
                                                                <th class="tituloDirectivoE">Directivos/as esperados</th>
                                                                <th class="tituloDirectivoR">Directivos/as reales</th>
                                                                <th class="tituloTituladoE">Titulados/as esperados</th>
                                                                <th class="tituloTituladoR">Titulados/as reales</th>
                                                                <th class="tituloGeneralE">General esperados</th>
                                                                <th class="tituloGeneralR">General reales</th>
                                                            </thead>
                                                        
                                                            <tbody>
                                                                @foreach ($internos as $interno)
                                                                    <tr>
                                                                        <td>{{ $interno->sede_nombre }}</td>
                                                                        <td>{{ $interno->escu_nombre }}</td>
                                                                        <td>{{ $interno->care_nombre }}</td>
                                                                        
                                                                        <td class="valueDocentesE">{{ $interno->pain_docentes ?? ($interno->pain_docentes === 0 ? 0 : '') }}</td>
                                                                        <td class="valueDocentesR">{{ $interno->pain_docentes_final ?? ($interno->pain_docentes_final === 0 ? 0 : '') }}</td>
                                                                        <td class="valueEstudiantesE">{{ $interno->pain_estudiantes ?? ($interno->pain_estudiantes === 0 ? 0 : '') }}</td>
                                                                        <td class="valueEstudiantesR">{{ $interno->pain_estudiantes_final ?? ($interno->pain_estudiantes_final === 0 ? 0 : '') }}</td>
                                                                        <td class="valueFuncionariosE">{{ $interno->pain_funcionarios ?? 0 }}</td>
                                                                        <td class="valueFuncionariosR">{{ $interno->pain_funcionarios_final ?? 0 }}</td>
                                                                        <td class="valueTituladosE">{{ $interno->pain_titulados ?? 0 }}</td>
                                                                        <td class="valueTituladosR">{{ $interno->pain_titulados_final ?? 0 }}</td>
                                                                        <td class="valueGeneralE">{{ $interno->pain_general ?? 0 }}</td>
                                                                        <td class="valueGeneralR">{{ $interno->pain_general_final ?? 0 }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        
                                                        <script>
                                                            $(document).ready(function() {
                                                                const hayTodas = @json($HayTodas);
                                                                
                                                                if (hayTodas) {
                                                                    $(".tituloDocentesE, .tituloDocentesR, .tituloDirectivoE, .tituloDirectivoR, .tituloEstudiantesE, .tituloEstudiantesR, .tituloTituladoE, .tituloTituladoR").hide();
                                                                    $(".valueDocentesE, .valueDocentesR, .valueFuncionariosE, .valueFuncionariosR, .valueEstudiantesE, .valueEstudiantesR, .valueTituladosE, .valueTituladosR").hide();
                                                                    $(".tituloGeneralE, .tituloGeneralR").show();
                                                                    $(".valueGeneralE, .valueGeneralR").show();
                                                                } else {
                                                                    $(".tituloDocentesE, .tituloDocentesR, .tituloDirectivoE, .tituloDirectivoR, .tituloEstudiantesE, .tituloEstudiantesR, .tituloTituladoE, .tituloTituladoR").show();
                                                                    $(".valueDocentesE, .valueDocentesR, .valueFuncionariosE, .valueFuncionariosR, .valueEstudiantesE, .valueEstudiantesR, .valueTituladosE, .valueTituladosR").show();
                                                                    $(".tituloGeneralE, .tituloGeneralR").hide();
                                                                    $(".valueGeneralE, .valueGeneralR").hide();
                                                                }
                                                            });
                                                        </script>
                                                    </div>
                                                </td>
                                            </tr>

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
                <div class="table-responsive">
                    <table class="table table-bordered table-md" id="table-1"
                        style="border-top: 1px ghostwhite solid;">
                        <tbody>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="modalEliminaIniciativa" tabindex="-1" role="dialog" aria-labelledby="modalEliminar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route($role . '.iniciativa.eliminar') }} " method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminar">Eliminar actividad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-ban text-danger" style="font-size: 50px; color"></i>
                        <h6 class="mt-2">La actividad dejará de existir dentro del sistema. <br> ¿Desea continuar de
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

    <script src="{{ asset('/js/admin/iniciativas/INVI.js') }}"></script>
    <script>
        function eliminarIniciativa(inic_codigo) {
            $('#inic_codigo').val(inic_codigo);
            $('#modalEliminaIniciativa').modal('show');
        }
    </script>

@endsection
