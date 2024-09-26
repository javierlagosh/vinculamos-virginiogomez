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

                            @if ($totalEvaluadores > 0)
                            <h4>Resultados de la evaluación de los {{$invitadoNombre}} para la iniciativa: {{ $iniciativa[0]->inic_nombre }}  </h4>
                            <input type="hidden" name="iniciativa_codigo" id="iniciativa_codigo"
                                value="{{ $iniciativa[0]->inic_codigo }}">

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

                        <h4 class="ml-4">Conocimiento de la iniciativa</h4>
                        <table class="table  ml-4 border">
                            <thead>
                                <tr>
                                    <th class="w-25">Pregunta</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td scope="col"><strong>¿Sabía usted que el propósito de ésta actividad era?</strong><br>
                                        {{ $iniciativa[0]->inic_descripcion }}

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">Si</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_conocimiento_1', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_conocimiento_1', 100)) * 100) / ( count($evaluacion->where('eval_conocimiento_1', 0)) + count($evaluacion->where('eval_conocimiento_1', 100)) ) ,1) }}
                                                        %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">No</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_conocimiento_1', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_conocimiento_1', 0)) * 100) / ( count($evaluacion->where('eval_conocimiento_1', 0)) + count($evaluacion->where('eval_conocimiento_1', 100)) ) ,1) }} %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['Si', {{count($evaluacion->where('eval_conocimiento_1', 100))}}],
                                        ['No', {{count($evaluacion->where('eval_conocimiento_1', 0))}}]
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>
                                <tr class="border">
                                    <td><strong>¿Sabía usted que los resultados esperados de la actividad eran?</strong><br>
                                        @if (count($resultados) > 0)
                                        <ul>
                                            @foreach ($resultados as $resultado)
                                                <li>{{ $resultado->resu_cuantificacion_inicial }}
                                                    x {{ $resultado->resu_nombre }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p>No hay resultados esperados</p>
                                        @endif
                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">Si</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_conocimiento_2', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_conocimiento_2', 100)) * 100) / ( count($evaluacion->where('eval_conocimiento_2', 0)) + count($evaluacion->where('eval_conocimiento_2', 100)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">No</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_conocimiento_2', 0))}}</td>
                                                    <td>{{  round((count($evaluacion->where('eval_conocimiento_2', 0)) * 100) / ( count($evaluacion->where('eval_conocimiento_2', 0)) + count($evaluacion->where('eval_conocimiento_2', 100)) ) ,1) }} %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart2"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['Si', {{count($evaluacion->where('eval_conocimiento_2', 100))}}],
                                        ['No', {{count($evaluacion->where('eval_conocimiento_2', 0))}}]
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>


                            </tbody>

                        </table>

                        <h4 class="ml-4">Cumplimiento de la Iniciativa</h4>
                        <table class="table  ml-4 border">
                            <thead>
                                <tr>
                                    <th class="w-25">Pregunta</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td scope="col"><strong>¿En qué % cree usted que se cumplió el objetivo?</strong><br>
                                        {{ $iniciativa[0]->inic_descripcion }}
                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">No se cumplió</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_1', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_1', 0)) * 100) / (( count($evaluacion->where('eval_cumplimiento_1', 100)) + count($evaluacion->where('eval_cumplimiento_1', 75)) + count($evaluacion->where('eval_cumplimiento_1', 50)) + count($evaluacion->where('eval_cumplimiento_1', 25)) + count($evaluacion->where('eval_cumplimiento_1', 0)) )) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">25%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_1', 25))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_1', 25)) * 100) / (( count($evaluacion->where('eval_cumplimiento_1', 100)) + count($evaluacion->where('eval_cumplimiento_1', 75)) + count($evaluacion->where('eval_cumplimiento_1', 50)) + count($evaluacion->where('eval_cumplimiento_1', 25)) + count($evaluacion->where('eval_cumplimiento_1', 0)) )) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">50%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_1', 50))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_1', 50)) * 100) / (( count($evaluacion->where('eval_cumplimiento_1', 100)) + count($evaluacion->where('eval_cumplimiento_1', 75)) + count($evaluacion->where('eval_cumplimiento_1', 50)) + count($evaluacion->where('eval_cumplimiento_1', 25)) + count($evaluacion->where('eval_cumplimiento_1', 0)) )) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">75%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_1', 75))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_1', 75)) * 100) / (( count($evaluacion->where('eval_cumplimiento_1', 100)) + count($evaluacion->where('eval_cumplimiento_1', 75)) + count($evaluacion->where('eval_cumplimiento_1', 50)) + count($evaluacion->where('eval_cumplimiento_1', 25)) + count($evaluacion->where('eval_cumplimiento_1', 0)) )) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">100%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_1', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_1', 100)) * 100) / (( count($evaluacion->where('eval_cumplimiento_1', 100)) + count($evaluacion->where('eval_cumplimiento_1', 75)) + count($evaluacion->where('eval_cumplimiento_1', 50)) + count($evaluacion->where('eval_cumplimiento_1', 25)) + count($evaluacion->where('eval_cumplimiento_1', 0)) )) ,1) }} %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart4"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_cumplimiento_1', 0)) }}],
                                        ['25%', {{count($evaluacion->where('eval_cumplimiento_1', 25)) }}],
                                        ['50%', {{count($evaluacion->where('eval_cumplimiento_1', 50)) }}],
                                        ['75%', {{count($evaluacion->where('eval_cumplimiento_1', 75)) }}],
                                        ['100%', {{count($evaluacion->where('eval_cumplimiento_1', 100)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>
                                <tr class="border">
                                    <td><strong>¿En qué % cree usted que se cumplió el resultado esperado?</strong><br>
                                        <ul>
                                            @foreach ($resultados as $resultado)
                                                <li>{{ $resultado->resu_cuantificacion_inicial }}
                                                    x {{ $resultado->resu_nombre }}
                                                </li>
                                            @endforeach
                                        </ul>

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">No se cumplió</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_2', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_2', 0)) * 100) / ( count($evaluacion->where('eval_cumplimiento_2', 100)) + count($evaluacion->where('eval_cumplimiento_2', 75)) + count($evaluacion->where('eval_cumplimiento_2', 50)) + count($evaluacion->where('eval_cumplimiento_2', 25)) + count($evaluacion->where('eval_cumplimiento_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">25%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_2', 25))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_2', 25)) * 100) / ( count($evaluacion->where('eval_cumplimiento_2', 100)) + count($evaluacion->where('eval_cumplimiento_2', 75)) + count($evaluacion->where('eval_cumplimiento_2', 50)) + count($evaluacion->where('eval_cumplimiento_2', 25)) + count($evaluacion->where('eval_cumplimiento_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">50%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_2', 50))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_2', 50)) * 100) / ( count($evaluacion->where('eval_cumplimiento_2', 100)) + count($evaluacion->where('eval_cumplimiento_2', 75)) + count($evaluacion->where('eval_cumplimiento_2', 50)) + count($evaluacion->where('eval_cumplimiento_2', 25)) + count($evaluacion->where('eval_cumplimiento_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">75%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_2', 75))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_2', 75)) * 100) / ( count($evaluacion->where('eval_cumplimiento_2', 100)) + count($evaluacion->where('eval_cumplimiento_2', 75)) + count($evaluacion->where('eval_cumplimiento_2', 50)) + count($evaluacion->where('eval_cumplimiento_2', 25)) + count($evaluacion->where('eval_cumplimiento_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">100%</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_cumplimiento_2', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_cumplimiento_2', 100)) * 100) / ( count($evaluacion->where('eval_cumplimiento_2', 100)) + count($evaluacion->where('eval_cumplimiento_2', 75)) + count($evaluacion->where('eval_cumplimiento_2', 50)) + count($evaluacion->where('eval_cumplimiento_2', 25)) + count($evaluacion->where('eval_cumplimiento_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart5"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_cumplimiento_2', 0)) }}],
                                        ['25%', {{count($evaluacion->where('eval_cumplimiento_2', 25)) }}],
                                        ['50%', {{count($evaluacion->where('eval_cumplimiento_2', 50)) }}],
                                        ['75%', {{count($evaluacion->where('eval_cumplimiento_2', 75)) }}],
                                        ['100%', {{count($evaluacion->where('eval_cumplimiento_2', 100)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart5'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>


                            </tbody>

                        </table>

                        <h4 class="ml-4">Calidad de ejecución</h4>
                        <table class="table  ml-4 border">
                            <thead>
                                <tr>
                                    <th class="w-25">Pregunta</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td scope="col">Plazo y horarios

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">0</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_1', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_1', 0)) * 100) / ( count($evaluacion->where('eval_calidad_1', 999)) + count($evaluacion->where('eval_calidad_1', 100)) + count($evaluacion->where('eval_calidad_1', 67)) + count($evaluacion->where('eval_calidad_1', 33)) + count($evaluacion->where('eval_calidad_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">1</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_1', 33))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_1', 33)) * 100) / ( count($evaluacion->where('eval_calidad_1', 999)) + count($evaluacion->where('eval_calidad_1', 100)) + count($evaluacion->where('eval_calidad_1', 67)) + count($evaluacion->where('eval_calidad_1', 33)) + count($evaluacion->where('eval_calidad_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">2</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_1', 67))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_1', 67)) * 100) / ( count($evaluacion->where('eval_calidad_1', 999)) + count($evaluacion->where('eval_calidad_1', 100)) + count($evaluacion->where('eval_calidad_1', 67)) + count($evaluacion->where('eval_calidad_1', 33)) + count($evaluacion->where('eval_calidad_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">3</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_1', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_1', 100)) * 100) / ( count($evaluacion->where('eval_calidad_1', 999)) + count($evaluacion->where('eval_calidad_1', 100)) + count($evaluacion->where('eval_calidad_1', 67)) + count($evaluacion->where('eval_calidad_1', 33)) + count($evaluacion->where('eval_calidad_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td  class="border-right">No aplica</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_1', 999))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_1', 999)) * 100) / ( count($evaluacion->where('eval_calidad_1', 999)) + count($evaluacion->where('eval_calidad_1', 100)) + count($evaluacion->where('eval_calidad_1', 67)) + count($evaluacion->where('eval_calidad_1', 33)) + count($evaluacion->where('eval_calidad_1', 0)) ) ,1) }} %</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart7"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_calidad_1', 0)) }}],
                                        ['1', {{count($evaluacion->where('eval_calidad_1', 33)) }}],
                                        ['2', {{count($evaluacion->where('eval_calidad_1', 67)) }}],
                                        ['3', {{count($evaluacion->where('eval_calidad_1', 100)) }}],
                                        // ['No aplica', {{count($evaluacion->where('eval_calidad_1', 999)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart7'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>
                                <tr class="border">
                                    <td>Equipamiento y/o infraestructura

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">0</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_2', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_2', 0)) * 100) / ( count($evaluacion->where('eval_calidad_2', 999)) + count($evaluacion->where('eval_calidad_2', 100)) + count($evaluacion->where('eval_calidad_2', 67)) + count($evaluacion->where('eval_calidad_2', 33)) + count($evaluacion->where('eval_calidad_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">1</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_2', 33))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_2', 33)) * 100) / ( count($evaluacion->where('eval_calidad_2', 999)) + count($evaluacion->where('eval_calidad_2', 100)) + count($evaluacion->where('eval_calidad_2', 67)) + count($evaluacion->where('eval_calidad_2', 33)) + count($evaluacion->where('eval_calidad_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">2</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_2', 67))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_2', 67)) * 100) / ( count($evaluacion->where('eval_calidad_2', 999)) + count($evaluacion->where('eval_calidad_2', 100)) + count($evaluacion->where('eval_calidad_2', 67)) + count($evaluacion->where('eval_calidad_2', 33)) + count($evaluacion->where('eval_calidad_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">3</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_2', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_2', 100)) * 100) / ( count($evaluacion->where('eval_calidad_2', 999)) + count($evaluacion->where('eval_calidad_2', 100)) + count($evaluacion->where('eval_calidad_2', 67)) + count($evaluacion->where('eval_calidad_2', 33)) + count($evaluacion->where('eval_calidad_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td  class="border-right">No aplica</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_2', 999))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_2', 999)) * 100) / ( count($evaluacion->where('eval_calidad_2', 999)) + count($evaluacion->where('eval_calidad_2', 100)) + count($evaluacion->where('eval_calidad_2', 67)) + count($evaluacion->where('eval_calidad_2', 33)) + count($evaluacion->where('eval_calidad_2', 0)) ) ,1) }} %</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart8"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_calidad_2', 0)) }}],
                                        ['1', {{count($evaluacion->where('eval_calidad_2', 33)) }}],
                                        ['2', {{count($evaluacion->where('eval_calidad_2', 67)) }}],
                                        ['3', {{count($evaluacion->where('eval_calidad_2', 100)) }}],
                                        // ['No aplica', {{count($evaluacion->where('eval_calidad_2', 999)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart8'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Conexión Digital y/ logística

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">0</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_3', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_3', 0)) * 100) / ( ( count($evaluacion->where('eval_calidad_3', 999)) + count($evaluacion->where('eval_calidad_3', 100)) + count($evaluacion->where('eval_calidad_3', 67)) + count($evaluacion->where('eval_calidad_3', 33)) + count($evaluacion->where('eval_calidad_3', 0)) ) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">1</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_3', 33))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_3', 33)) * 100) / ( ( count($evaluacion->where('eval_calidad_3', 999)) + count($evaluacion->where('eval_calidad_3', 100)) + count($evaluacion->where('eval_calidad_3', 67)) + count($evaluacion->where('eval_calidad_3', 33)) + count($evaluacion->where('eval_calidad_3', 0)) ) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">2</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_3', 67))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_3', 67)) * 100) / ( ( count($evaluacion->where('eval_calidad_3', 999)) + count($evaluacion->where('eval_calidad_3', 100)) + count($evaluacion->where('eval_calidad_3', 67)) + count($evaluacion->where('eval_calidad_3', 33)) + count($evaluacion->where('eval_calidad_3', 0)) ) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">3</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_3', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_3', 100)) * 100) / ( ( count($evaluacion->where('eval_calidad_3', 999)) + count($evaluacion->where('eval_calidad_3', 100)) + count($evaluacion->where('eval_calidad_3', 67)) + count($evaluacion->where('eval_calidad_3', 33)) + count($evaluacion->where('eval_calidad_3', 0)) ) ) ,1) }} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td  class="border-right">No aplica</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_3', 999))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_3', 999)) * 100) / ( count($evaluacion->where('eval_calidad_3', 999)) + count($evaluacion->where('eval_calidad_3', 100)) + count($evaluacion->where('eval_calidad_3', 67)) + count($evaluacion->where('eval_calidad_3', 33)) + count($evaluacion->where('eval_calidad_3', 0)) ) ,1) }} %</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart9"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_calidad_3', 0)) }}],
                                        ['1', {{count($evaluacion->where('eval_calidad_3', 33)) }}],
                                        ['2', {{count($evaluacion->where('eval_calidad_3', 67)) }}],
                                        ['3', {{count($evaluacion->where('eval_calidad_3', 100)) }}],
                                        // ['No aplica', {{count($evaluacion->where('eval_calidad_3', 999)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart9'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Presentación y/o desarrollo de la actividad

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">0</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_4', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_4', 0)) * 100) / ( count($evaluacion->where('eval_calidad_4', 999)) + count($evaluacion->where('eval_calidad_4', 100)) + count($evaluacion->where('eval_calidad_4', 67)) + count($evaluacion->where('eval_calidad_4', 33)) + count($evaluacion->where('eval_calidad_4', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">1</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_4', 33))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_4', 33)) * 100) / ( count($evaluacion->where('eval_calidad_4', 999)) + count($evaluacion->where('eval_calidad_4', 100)) + count($evaluacion->where('eval_calidad_4', 67)) + count($evaluacion->where('eval_calidad_4', 33)) + count($evaluacion->where('eval_calidad_4', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">2</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_4', 67))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_4', 67)) * 100) / ( count($evaluacion->where('eval_calidad_4', 999)) + count($evaluacion->where('eval_calidad_4', 100)) + count($evaluacion->where('eval_calidad_4', 67)) + count($evaluacion->where('eval_calidad_4', 33)) + count($evaluacion->where('eval_calidad_4', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">3</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_4', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_4', 100)) * 100) / ( count($evaluacion->where('eval_calidad_4', 999)) + count($evaluacion->where('eval_calidad_4', 100)) + count($evaluacion->where('eval_calidad_4', 67)) + count($evaluacion->where('eval_calidad_4', 33)) + count($evaluacion->where('eval_calidad_4', 0)) ) ,1) }} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td  class="border-right">No aplica</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_calidad_4', 999))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_calidad_4', 999)) * 100) / ( count($evaluacion->where('eval_calidad_4', 999)) + count($evaluacion->where('eval_calidad_4', 100)) + count($evaluacion->where('eval_calidad_4', 67)) + count($evaluacion->where('eval_calidad_4', 33)) + count($evaluacion->where('eval_calidad_4', 0)) ) ,1) }} %</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart10"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_calidad_4', 0)) }}],
                                        ['1', {{count($evaluacion->where('eval_calidad_4', 33)) }}],
                                        ['2', {{count($evaluacion->where('eval_calidad_4', 67)) }}],
                                        ['3', {{count($evaluacion->where('eval_calidad_4', 100)) }}],
                                        // ['No aplica', {{count($evaluacion->where('eval_calidad_4', 999)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart10'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                        @if ($invitado == 0)
                        <h4 class="ml-4">Competencia de estudiantes</h4>
                        <table class="table  ml-4 border">
                            <thead>
                                <tr>
                                    <th class="w-25">Pregunta</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td scope="col">Capacidad para ejecutar las actividades.

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">0</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_1', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_1', 0)) * 100) / ( count($evaluacion->where('eval_competencia_1', 999)) + count($evaluacion->where('eval_competencia_1', 100)) + count($evaluacion->where('eval_competencia_1', 67)) + count($evaluacion->where('eval_competencia_1', 33)) + count($evaluacion->where('eval_competencia_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">1</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_1', 33))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_1', 33)) * 100) / ( count($evaluacion->where('eval_competencia_1', 999)) + count($evaluacion->where('eval_competencia_1', 100)) + count($evaluacion->where('eval_competencia_1', 67)) + count($evaluacion->where('eval_competencia_1', 33)) + count($evaluacion->where('eval_competencia_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">2</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_1', 67))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_1', 67)) * 100) / ( count($evaluacion->where('eval_competencia_1', 999)) + count($evaluacion->where('eval_competencia_1', 100)) + count($evaluacion->where('eval_competencia_1', 67)) + count($evaluacion->where('eval_competencia_1', 33)) + count($evaluacion->where('eval_competencia_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">3</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_1', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_1', 100)) * 100) / ( count($evaluacion->where('eval_competencia_1', 999)) + count($evaluacion->where('eval_competencia_1', 100)) + count($evaluacion->where('eval_competencia_1', 67)) + count($evaluacion->where('eval_competencia_1', 33)) + count($evaluacion->where('eval_competencia_1', 0)) ) ,1) }} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td  class="border-right">No aplica</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_1', 999))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_1', 999)) * 100) / ( count($evaluacion->where('eval_competencia_1', 999)) + count($evaluacion->where('eval_competencia_1', 100)) + count($evaluacion->where('eval_competencia_1', 67)) + count($evaluacion->where('eval_competencia_1', 33)) + count($evaluacion->where('eval_competencia_1', 0)) ) ,1) }} %</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart11"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_competencia_1', 0)) }}],
                                        ['1', {{count($evaluacion->where('eval_competencia_1', 33)) }}],
                                        ['2', {{count($evaluacion->where('eval_competencia_1', 67)) }}],
                                        ['3', {{count($evaluacion->where('eval_competencia_1', 100)) }}],
                                        // ['No aplica', {{count($evaluacion->where('eval_competencia_1', 999)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart11'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>
                                <tr class="border">
                                    <td>Actitud positiva para ejecutar actividades.

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">0</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_2', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_2', 0)) * 100) / (count($evaluacion->where('eval_competencia_2', 999)) + count($evaluacion->where('eval_competencia_2', 100)) + count($evaluacion->where('eval_competencia_2', 67)) + count($evaluacion->where('eval_competencia_2', 33)) + count($evaluacion->where('eval_competencia_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">1</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_2', 33))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_2', 33)) * 100) / (count($evaluacion->where('eval_competencia_2', 999)) + count($evaluacion->where('eval_competencia_2', 100)) + count($evaluacion->where('eval_competencia_2', 67)) + count($evaluacion->where('eval_competencia_2', 33)) + count($evaluacion->where('eval_competencia_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">2</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_2', 67))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_2', 67)) * 100) / (count($evaluacion->where('eval_competencia_2', 999)) + count($evaluacion->where('eval_competencia_2', 100)) + count($evaluacion->where('eval_competencia_2', 67)) + count($evaluacion->where('eval_competencia_2', 33)) + count($evaluacion->where('eval_competencia_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">3</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_2', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_2', 100)) * 100) / (count($evaluacion->where('eval_competencia_2', 999)) + count($evaluacion->where('eval_competencia_2', 100)) + count($evaluacion->where('eval_competencia_2', 67)) + count($evaluacion->where('eval_competencia_2', 33)) + count($evaluacion->where('eval_competencia_2', 0)) ) ,1) }} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td  class="border-right">No aplica</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_2', 999))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_2', 999)) * 100) / (count($evaluacion->where('eval_competencia_2', 999)) + count($evaluacion->where('eval_competencia_2', 100)) + count($evaluacion->where('eval_competencia_2', 67)) + count($evaluacion->where('eval_competencia_2', 33)) + count($evaluacion->where('eval_competencia_2', 0)) ) ,1) }} %</td></td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart12"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_competencia_2', 0)) }}],
                                        ['1', {{count($evaluacion->where('eval_competencia_2', 33)) }}],
                                        ['2', {{count($evaluacion->where('eval_competencia_2', 67)) }}],
                                        ['3', {{count($evaluacion->where('eval_competencia_2', 100)) }}],
                                        // ['No aplica', {{count($evaluacion->where('eval_competencia_2', 999)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart12'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Habilidad para resolver problemas.

                                    </td>
                                    <td>
                                        <table class="table ">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="w-25 text-center"></th>
                                                    <th class="w-25 text-center">Alternativas</th>
                                                    <th class="w-25 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td  class="border-right">0</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_3', 0))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_3', 0)) * 100) / (count($evaluacion->where('eval_competencia_3', 999)) + count($evaluacion->where('eval_competencia_3', 100)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 33)) + count($evaluacion->where('eval_competencia_3', 0))) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">1</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_3', 33))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_3', 33)) * 100) / (count($evaluacion->where('eval_competencia_3', 999)) + count($evaluacion->where('eval_competencia_3', 100)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 33)) + count($evaluacion->where('eval_competencia_3', 0))) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">2</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_3', 67))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_3', 67)) * 100) / (count($evaluacion->where('eval_competencia_3', 999)) + count($evaluacion->where('eval_competencia_3', 100)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 33)) + count($evaluacion->where('eval_competencia_3', 0))) ,1) }} %</td>
                                                </tr>
                                                <tr>
                                                    <td  class="border-right">3</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_3', 100))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_3', 100)) * 100) / (count($evaluacion->where('eval_competencia_3', 999)) + count($evaluacion->where('eval_competencia_3', 100)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 33)) + count($evaluacion->where('eval_competencia_3', 0))) ,1) }} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td  class="border-right">No aplica</td>
                                                    <td  class="border-right">{{count($evaluacion->where('eval_competencia_3', 999))}}</td>
                                                    <td>{{ round((count($evaluacion->where('eval_competencia_3', 999)) * 100) / (count($evaluacion->where('eval_competencia_3', 999)) + count($evaluacion->where('eval_competencia_3', 100)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 67)) + count($evaluacion->where('eval_competencia_3', 33)) + count($evaluacion->where('eval_competencia_3', 0))) ,1) }} %</td></td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div id="piechart13"></div>
                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                        <script type="text/javascript">
                                        // Load google charts
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);
                                        function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Alternativas'],
                                        ['No se cumplió', {{count($evaluacion->where('eval_competencia_3', 0)) }}],
                                        ['1', {{count($evaluacion->where('eval_competencia_3', 33)) }}],
                                        ['2', {{count($evaluacion->where('eval_competencia_3', 67)) }}],
                                        ['3', {{count($evaluacion->where('eval_competencia_3', 100)) }}],
                                        // ['No aplica', {{count($evaluacion->where('eval_competencia_3', 999)) }}],
                                        ]);
                                        var options = {'width':225, 'height':200};
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart13'));
                                        chart.draw(data, options);
                                        }
                                        </script>
                                    </td>
                                </tr>

                            </tbody>

                        </table>


                        @endif
                        <div class="row mb-3">
                            <div class="col-xl-12 col-md-12 col-log-12">
                                <div class="text-right">
                                    <strong>
                                        <a href="javascript:history.back()"
                                            class="btn mr-1 waves-effect"
                                            style="background-color:#042344; color:white"><i
                                                class="fas fa-chevron-left"></i>
                                            Volver</a>
                                    </strong>

                                    <a href="{{ route('admin.iniciativas.detalles', $iniciativa[0]->inic_codigo) }}"
                                        type="button" class="btn btn-primary mr-1 waves-effect">
                                        Ver Iniciativa <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        @else
                        <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                <strong>¡Lo siento!</strong> No se encontraron respuestas para esta iniciativa.
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-12 col-md-12 col-log-12">
                                    <div class="text-right">
                                        <strong>
                                            <a href="javascript:history.back()"
                                                class="btn mr-1 waves-effect"
                                                style="background-color:#042344; color:white"><i
                                                    class="fas fa-chevron-left"></i>
                                                Volver</a>
                                        </strong>

                                        <a href="{{ route('admin.iniciativas.detalles', $iniciativa[0]->inic_codigo) }}"
                                            type="button" class="btn btn-primary mr-1 waves-effect">
                                            Ver Iniciativa <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        @endif





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
