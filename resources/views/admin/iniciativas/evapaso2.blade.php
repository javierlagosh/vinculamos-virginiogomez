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
            <div class="col-xl-12">
                <div class="row"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Evaluación de la iniciativa: {{$iniciativa[0]->inic_nombre}}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.iniciativas.detalles', $iniciativa[0]->inic_codigo) }}"
                               class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                <i class="fas fa-angle-left"></i> Volver a la Iniciativa
                            </a>
                        </div>
                    </div>



                        <div >

                            <div class="mx-5 mt-3 ">
                                <h5>Paso 2: Propuesta de evaluación</h5>
                                <p  ><span style="color:red;">! </span>Instrucción: Revisa que todos los campos de la encuesta estén completos, y da clic en "Paso Siguiente" al final de la página para avanzar. </p>
                            </div>
                            <hr style="
                            border: 0;
                            background-color: white;
                            width: 100%;
                            border-top: 1px solid rgba(0, 0, 0, 0.1);" />

                            <div class="mx-5">
                                Estimado/a, <br>
                                                Le agradecemos haber participado en la actividad "{{$iniciativa[0]->inic_nombre}}" en el marco de las acciones de Vinculación con el medio que implementa el IP Virginio Gómez.
                            </div>
                            <div class="mx-5 mt-5">
                                <form>
                                    <!-- Sección Objetivo -->
                                    <section class="mb-5">
                                        <h5>Conocimiento y Cumplimiento</h5>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">¿Sabía usted que el propósito u objetivo de ésta actividad era?</label>
                                            <label class="form-label">{{ $iniciativa[0]->inic_descripcion }}</label>
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="conocimientoObjetivo" id="siConociaObjetivo" value="si">
                                                    <label class="form-check-label" for="siConociaObjetivo">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="conocimientoObjetivo" id="noConociaObjetivo" value="no">
                                                    <label class="form-check-label" for="noConociaObjetivo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">¿En qué % cree usted que se cumplió el propósito u objetivo?</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoObjetivo" id="noCumplioObjetivo" value="0">
                                                    <label class="form-check-label" for="noCumplioObjetivo">No se cumplió</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoObjetivo" id="cumplio25Objetivo" value="25">
                                                    <label class="form-check-label" for="cumplio25Objetivo">25%</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoObjetivo" id="cumplio50Objetivo" value="50">
                                                    <label class="form-check-label" for="cumplio50Objetivo">50%</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoObjetivo" id="cumplio75Objetivo" value="75">
                                                    <label class="form-check-label" for="cumplio75Objetivo">75%</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cumplimientoObjetivo" id="cumplio100Objetivo" value="100">
                                                    <label class="form-check-label" for="cumplio100Objetivo">100%</label>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- Sección Contribuciones -->
                                    <section class="mb-5">
                                        <h5>Contribuciones</h5>
                                        <div class="mb-3">
                                            <label class="form-label"><span class="font-weight-bold">¿Sabía usted que las contribuciones esperadas eran?</span>
                                                @if (count($contribuciones) > 0)
                                                <ul>
                                                    @foreach ($contribuciones as $contribucion)
                                                        <li>{{ $contribucion->amb_nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>No hay contribuciones esperadas</p>
                                            @endif

                                            </label>
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="conocimientoContribucion" id="siConociaContribucion" value="si">
                                                    <label class="form-check-label" for="siConociaContribucion">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="conocimientoContribucion" id="noConociaContribucion" value="no">
                                                    <label class="form-check-label" for="noConociaContribucion">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">¿En qué % cree usted que se cumplirán las contribuciones?</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoContribucion" id="noCumplioContribucion" value="0">
                                                    <label class="form-check-label" for="noCumplioContribucion">No se cumplió</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoContribucion" id="cumplio25Contribucion" value="25">
                                                    <label class="form-check-label" for="cumplio25Contribucion">25%</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoContribucion" id="cumplio50Contribucion" value="50">
                                                    <label class="form-check-label" for="cumplio50Contribucion">50%</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoContribucion" id="cumplio75Contribucion" value="75">
                                                    <label class="form-check-label" for="cumplio75Contribucion">75%</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cumplimientoContribucion" id="cumplio100Contribucion" value="100">
                                                    <label class="form-check-label" for="cumplio100Contribucion">100%</label>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- Sección Resultado -->
                                    <section class="mb-5">
                                        <h5>Resultados</h5>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">¿Sabía usted que el resultado de ésta actividad era?</label>
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
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="conocimientoResultado" id="siConociaResultado" value="si">
                                                    <label class="form-check-label" for="siConociaResultado">Sí</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="conocimientoResultado" id="noConociaResultado" value="no">
                                                    <label class="form-check-label" for="noConociaResultado">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">¿En qué % cree usted que se cumplió el resultado?</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoResultado" id="noCumplioResultado" value="0">
                                                    <label class="form-check-label" for="noCumplioResultado">No se cumplió</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoResultado" id="cumplio25Resultado" value="25">
                                                    <label class="form-check-label" for="cumplio25Resultado">25%</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoResultado" id="cumplio50Resultado" value="50">
                                                    <label class="form-check-label" for="cumplio50Resultado">50%</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="cumplimientoResultado" id="cumplio75Resultado" value="75">
                                                    <label class="form-check-label" for="cumplio75Resultado">75%</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cumplimientoResultado" id="cumplio100Resultado" value="100">
                                                    <label class="form-check-label" for="cumplio100Resultado">100%</label>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- Sección Calidad -->
                                    <section class="mb-5">
                                        <h5>Calidad</h5>
                                        <p class="mb-3">A continuación te pedimos que evalúes de 0 a 3 la calidad en la ejecución de la actividad, según los compromisos asumidos por la institución, en que:</p>
                                        <ul class="mb-3">
                                            <li>0 = no cumple</li>
                                            <li>1 = cumple mínimamente</li>
                                            <li>2 = cumple medianamente</li>
                                            <li>3 = cumple totalmente</li>
                                        </ul>
                                        {{-- <p class="mb-3">Si considera que algunos ítemes no estaban comprometidos, marque No Aplica.</p> --}}
                                        

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Plazo y horarios (Inicio y término)</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_plazos" id="plazos0" value="0">
                                                    <label class="form-check-label" for="plazos0">0</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_plazos" id="plazos1" value="1">
                                                    <label class="form-check-label" for="plazos1">1</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_plazos" id="plazos2" value="2">
                                                    <label class="form-check-label" for="plazos2">2</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_plazos" id="plazos3" value="3">
                                                    <label class="form-check-label" for="plazos3">3</label>
                                                </div>
                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="calidad_plazos" id="plazosNA" value="NA">
                                                    <label class="form-check-label" for="plazosNA">No aplica</label>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Equipamiento y/o infraestructura (Lugar, mobiliario, equipos)</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_equipamiento" id="equipamiento0" value="0">
                                                    <label class="form-check-label" for="equipamiento0">0</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_equipamiento" id="equipamiento1" value="1">
                                                    <label class="form-check-label" for="equipamiento1">1</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_equipamiento" id="equipamiento2" value="2">
                                                    <label class="form-check-label" for="equipamiento2">2</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_equipamiento" id="equipamiento3" value="3">
                                                    <label class="form-check-label" for="equipamiento3">3</label>
                                                </div>
                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="calidad_equipamiento" id="equipamientoNA" value="NA">
                                                    <label class="form-check-label" for="equipamientoNA">No aplica</label>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Logística (Coordinaciones, conexión web)</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_logistica" id="logistica0" value="0">
                                                    <label class="form-check-label" for="logistica0">0</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_logistica" id="logistica1" value="1">
                                                    <label class="form-check-label" for="logistica1">1</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_logistica" id="logistica2" value="2">
                                                    <label class="form-check-label" for="logistica2">2</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_logistica" id="logistica3" value="3">
                                                    <label class="form-check-label" for="logistica3">3</label>
                                                </div>
                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="calidad_logistica" id="logisticaNA" value="NA">
                                                    <label class="form-check-label" for="logisticaNA">No aplica</label>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Presentaciones (Charla, presentación, relatoría)</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_presentaciones" id="presentaciones0" value="0">
                                                    <label class="form-check-label" for="presentaciones0">0</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_presentaciones" id="presentaciones1" value="1">
                                                    <label class="form-check-label" for="presentaciones1">1</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_presentaciones" id="presentaciones2" value="2">
                                                    <label class="form-check-label" for="presentaciones2">2</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="calidad_presentaciones" id="presentaciones3" value="3">
                                                    <label class="form-check-label" for="presentaciones3">3</label>
                                                </div>
                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="calidad_presentaciones" id="presentacionesNA" value="NA">
                                                    <label class="form-check-label" for="presentacionesNA">No aplica</label>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </section>
                          {{-- Sección de estudiantes --}}
            @if($invitado == 0)
            <section class="mb-5">

                <h5>Competencia de estudiantes</h5>
                <p class="mb-3">Ahora, siguiendo la misma escala de 0 a 3, te pedimos que evalúes si te sirvió la actividad para desarrollar algunas de las siguientes dimensiones de las competencias comprometidas.</p>
                <ul class="mb-3">
                    <li>0 = no cumple</li>
                    <li>1 = cumple mínimamente</li>
                    <li>2 = cumple medianamente</li>
                    <li>3 = cumple totalmente</li>
                </ul>

                

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Capacidad para ejecutar las actividades.</label>
                    <div class="d-flex flex-wrap">
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_ejecutar" id="estudiantes_ejecutar0" value="0">
                            <label class="form-check-label" for="estudiantes_ejecutar0">0</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_ejecutar" id="estudiantes_ejecutar1" value="33">
                            <label class="form-check-label" for="estudiantes_ejecutar1">1</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_ejecutar" id="estudiantes_ejecutar2" value="67">
                            <label class="form-check-label" for="estudiantes_ejecutar2">2</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_ejecutar" id="estudiantes_ejecutar3" value="100">
                            <label class="form-check-label" for="estudiantes_ejecutar3">3</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Actitud positiva para ejecutar actividades.</label>
                    <div class="d-flex flex-wrap">
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_positividad" id="estudiantes_positividad0" value="0">
                            <label class="form-check-label" for="estudiantes_positividad0">0</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_positividad" id="estudiantes_positividad1" value="33">
                            <label class="form-check-label" for="estudiantes_positividad1">1</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_positividad" id="estudiantes_positividad2" value="67">
                            <label class="form-check-label" for="estudiantes_positividad2">2</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_positividad" id="estudiantes_positividad3" value="100">
                            <label class="form-check-label" for="estudiantes_positividad3">3</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Habilidad para resolver problemas.</label>
                    <div class="d-flex flex-wrap">
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_resolucion" id="estudiantes_resolucion0" value="0">
                            <label class="form-check-label" for="estudiantes_resolucion0">0</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_resolucion" id="estudiantes_resolucion1" value="33">
                            <label class="form-check-label" for="estudiantes_resolucion1">1</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_resolucion" id="estudiantes_resolucion2" value="67">
                            <label class="form-check-label" for="estudiantes_resolucion2">2</label>
                        </div>
                        <div class="form-check me-3 mr-3">
                            <input class="form-check-input" type="radio" name="estudiantes_resolucion" id="estudiantes_resolucion3" value="100">
                            <label class="form-check-label" for="estudiantes_resolucion3">3</label>
                        </div>
                    </div>
                </div>


            </section>
            @endif


                                </form>
                            </div>
                              <div class="row">
                                <div class="col-xl-12 col-md-12 col-log-12">
                                    <div class="text-right mr-3 mb-3">
                                        <strong>
                                            <a href="{{route('admin.evaluar.iniciativa', [$iniciativa[0]->inic_codigo])}}"
                                                type="button" class="btn mr-1 waves-effect"
                                                style="background-color:#042344; color:white"><i
                                                    class="fas fa-chevron-left"></i>
                                                Paso anterior</a>
                                        </strong>

                                        <a href="{{route('admin.iniciativa.evaluar.invitar', [$iniciativa[0]->inic_codigo, $invitado])}}"
                                            type="button" class="btn btn-primary mr-1 waves-effect">
                                            Paso siguiente <i class="fas fa-chevron-right"></i></a>
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

@endsection
