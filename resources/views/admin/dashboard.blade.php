@extends('admin.panel')
@section('contenido')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card card-success">
                        <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                            <h4>Análisis General de Vinculación con el Medio </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-xl-4 col-lg-4">
                                    <div class="card l-bg-green">
                                        <div class="card-statistic-3">
                                            <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                                            <div class="card-content">
                                                <h3 class="font-light mb-0"
                                                    style="display: flex; justify-content: center; align-items: center;">
                                                    @if (count($nIniciativas) > 0)
                                                        <i class="ti-arrow-up text-success"></i> <label
                                                            style="font-size: 80%">{{ count($nIniciativas) }}</label>
                                                    @else
                                                        <i class="ti-arrow-up text-success"></i> <label
                                                            style="font-size: 80%">No
                                                            hay registro</label>
                                                    @endif
                                                </h3>
                                                <h4 class="card-title"
                                                    style="display: flex; justify-content: center; align-items: center;">
                                                    Actividades
                                                </h4>

                                                <p class="mb-0 text-sm">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-statistic-2">
                                        <div class="card-icon l-bg-green">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        @if (count($comunas) > 0)
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">{{ count($comunas) }}</label>
                                                        @else
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">No hay registro</label>
                                                        @endif
                                                    </h3>
                                                    <h5 class="card-title">Comunas</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-statistic-2">
                                        <div class="card-icon l-bg-cyan">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        @if (count($nEstudiantes) > 0)
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">{{ $nEstudiantes[0]->estudiantes }}</label>
                                                        @else
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">No hay registro</label>
                                                        @endif
                                                    </h3>
                                                    <h5 class="card-title">Estudiantes</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-statistic-2">
                                        <div class="card-icon l-bg-orange">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        @if (count($nDocentes) > 0)
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">{{ $nDocentes[0]->docentes }}</label>
                                                        @else
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">No hay registro</label>
                                                        @endif
                                                    </h3>
                                                    <h5 class="card-title">Docentes</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-statistic-2">
                                        <div class="card-icon l-bg-green">
                                            <i class="fas fa-users-cog"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        @if (count($nSocios) > 0)
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">{{ count($nSocios) }}</label>
                                                        @else
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">No hay registro</label>
                                                        @endif
                                                    </h3>
                                                    <h5 class="card-title">Socios/as Comunitarios</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card card-statistic-2">
                                        <div class="card-icon l-bg-purple">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="padding-20">
                                                <div class="text-right">
                                                    <h3 class="font-light mb-0">
                                                        @if (count($nBeneficiarios) > 0)
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">{{ $nBeneficiarios[0]->beneficiarios }}</label>
                                                        @else
                                                            <i class="ti-arrow-up text-success"></i> <label
                                                                style="font-size: 80%">No hay registro</label>
                                                        @endif

                                                    </h3>
                                                    <h5 class="card-title">Beneficiarios y beneficiarias</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- //TODO: Cobertura x Sede --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h5 style="margin-right: 10%">Cobertura por sede</h5>
                            <div class="card-header-action">
                                <select class="form-control select2" id="select_sede" name="select_sede"
                                    onchange="cargarSedes()" style="width: 100%">
                                    <option value="" disabled style="font-size: 40%">Seleccione
                                        sede ...</option>
                                    <option value="all">Todas las sedes</option>
                                    @forelse ($sedes as $sede)
                                        <option value="{{ $sede->sede_codigo }}">
                                            {{ $sede->sede_nombre }}</option>
                                    @empty
                                        <option value="-1">No existen registros</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-xl-4 col-lg-6">
                                    <div class="card l-bg-cyan">
                                        <div class="card-statistic-3">
                                            <div class="card-icon card-icon-large">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div class="card-content">
                                                <h4 class="card-title">Estudiantes</h4>
                                                <h6 id="sede_estudiantes" class="card-title"></h6>
                                                {{-- TODO: BARRA DE PROGRESO,es necesario modificar el style: width para que la barra de progreso avance --}}
                                                <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
                                                    <div class="progress-bar l-bg-orange" role="progressbar"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                                        id="sede_estudiantes_porcentaje_bar"></div>
                                                </div>
                                                <p class="mb0 text-sm">
                                                <h6 class="card-title" id="sede_estudiantes_porcentaje">

                                                </h6>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6">
                                    <div class="card l-bg-orange">
                                        <div class="card-statistic-3">
                                            <div class="card-icon card-icon-large">
                                                <i class="fa fa-user-tie"></i>
                                            </div>
                                            <div class="card-content">
                                                <h4 class="card-title">Docentes</h4>
                                                <h6 id="sede_docentes" class="card-title"></h6>
                                                {{-- TODO: BARRA DE PROGRESO,es necesario modificar el style: width para que la barra de progreso avance --}}
                                                <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
                                                    <div class="progress-bar l-bg-cyan" role="progressbar"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                                        id="sede_docentes_porcentaje_bar"></div>
                                                </div>
                                                <p class="mb0 text-sm">
                                                <h6 class="card-title" id="sede_docentes_porcentaje">

                                                </h6>
                                                {{-- <span class="text-nowrap">Completado</span> --}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6">
                                    <div class="card l-bg-green">
                                        <div class="card-statistic-3">
                                            <div class="card-icon card-icon-large">
                                                <i class="fa fa-award"></i>
                                            </div>
                                            <div class="card-content">
                                                <h4 class="card-title">Actividades</h4>
                                                <h6 id="iniciativas_sedes" class="card-title"></h6>
                                                {{-- TODO: BARRA DE PROGRESO,es necesario modificar el style: width para que la barra de progreso avance --}}
                                                <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
                                                    <div class="progress-bar l-bg-cyan" role="progressbar"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                                        id="iniciativas_sedes_porcentaje_bar"></div>
                                                </div>
                                                <p class="mb0 text-sm">
                                                <h6 class="card-title" id="iniciativas_sedes_porcentaje">

                                                </h6>
                                                {{-- <span class="text-nowrap">Completado</span> --}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Actividades por grupos</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5 id="iniciativaXgrupoError"></h5>
                                            <div id="iniciativaXgrupo"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Actividades por comuna</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5 id="iniciativaXcomunaError"></h5>
                                            <div id="iniciativaXcomuna"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Actividades por estado</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5 id="iniciativaXestadoError"></h5>
                                            <div id="iniciativaXestado"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Actividades por año</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5 id="iniciativaXanhoError"></h5>
                                            <div id="iniciativaXanho"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('/js/admin/dashboard/sedes-datos.js')}}"></script>
@endsection
