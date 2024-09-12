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


<div class="modal fade" id="modalEliminaEvaluacion" tabindex="-1" role="dialog" aria-labelledby="modalEliminar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.eliminar.evaluacion.manual') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminar">Eliminar Evaluación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-ban text-danger" style="font-size: 50px; color"></i>
                        <h6 class="mt-2">La evaluación dejará de existir dentro del sistema. <br> ¿Desea continuar de
                            todos modos? <br> Considere que su decición influirá en el valor del indicador INVI</h6>
                        <input type="hidden" id="eval_codigo" name="eval_codigo" value="">
                        <input type="hidden" id="inic_codigo" name="inic_codigo" value="{{ $iniciativa[0]->inic_codigo }}">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var token = '{{ csrf_token() }}';

        function listarEval(inic_code) {
        $.ajax({
            type: 'GET',
            url: `${window.location.origin}/admin/iniciativa/listar-evaluaciones`,
            data: {
                _token: '{{ csrf_token() }}',
                inic_codigo: inic_code
            },

            success: function(resConsultar) {
                respuesta = JSON.parse(resConsultar);
                $('#body-tabla-evaluaciones').empty();
                $('#N_evaluacion').empty();
                $('#P_evaluacion').empty();

                datos_evaluaciones = respuesta.resultado;
                let contador = 0;
                let ptj = 0;

                datos_evaluaciones.forEach(registro => {
                    contador = contador + 1;
                    ptj = ptj + registro.eval_puntaje;
                    let evaluacionTipo = registro.eval_evaluador === 2 ? 'Evaluación Interna' : 'Evaluación Externa';

                    fila = `<tr>
                        <td>${contador}</td>
                        <td>${registro.eval_nickname_mod}</td>
                        <td>${evaluacionTipo}</td>
                        <td>${registro.eval_puntaje}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-icon btn-danger"
                                onclick="eliminarEval(${registro.eval_codigo})"
                                data-toggle="tooltip" data-placement="top"
                                title="Eliminar mecanismo"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>`

                    $('#body-tabla-evaluaciones').append(fila);
                });

                $('#N_evaluacion').text(contador);
                $('#P_evaluacion').text(Math.round(ptj / contador));
            }
        })
    }

function eliminarEval(eval_codigo) {
$('#modalEliminaEvaluacion').find('#eval_codigo').val(eval_codigo);
$('#modalEliminaEvaluacion').modal('show');
}

function ingresarEVAL() {
var selectBox = document.getElementById("ingresar");
var etiquetasInterna = document.getElementsByName('Eval_Interna');
var etiquetasExterna = document.getElementsByName('Eval_Externa');
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
/* Mostrar Tabla */
var MostrarTabla = document.getElementById("AllTable");
MostrarTabla.style.display = "block";
/* Ocultar Formulario */


/* Interna */
if (selectedValue === "2") {
    mostrarEtiquetas(etiquetasInterna);
    ocultarEtiquetas(etiquetasExterna);
}
/* Externa */
if (selectedValue === "3") {
    ocultarEtiquetas(etiquetasInterna);
    mostrarEtiquetas(etiquetasExterna);
}
/* Limpiar */
if (selectedValue === "4") {
    MostrarTabla.style.display = "none";
    MostrarSiempre.style.display = "none";
}

}

function mostrarOcultar() {
var selectBox = document.getElementById("tipo");

var etiquetasEstudiante = document.getElementsByName('etiquetasEstudiante');
var etiquetasOtras = document.getElementsByName('etiquetasOtras');


var selectedValue = selectBox.options[selectBox.selectedIndex].value;

// Obtén el div por su ID
var divAMostrar = document.getElementById("divAMostrar");
/* Mostrar Formulario */

/* Ocultar Tabla */
var MostrarTabla = document.getElementById("AllTable");
MostrarTabla.style.display = "none";


ocultarEtiquetas(etiquetasEstudiante);
ocultarEtiquetas(etiquetasOtras);

// Oculta el div si la opción seleccionada es "Evaluador externo", de lo contrario, muéstralo
if (selectedValue === "1") {
    mostrarEtiquetas(etiquetasEstudiante);
} else {
    mostrarEtiquetas(etiquetasOtras);
}

if (selectedValue === "3") {
    divAMostrar.style.display = "none";
} else {
    divAMostrar.style.display = "block";
}
if (selectedValue === "4") {
    MostrarSiempre.style.display = "none";
    MostrarTabla.style.display = "none";
}
}

function ocultarEtiquetas(etiquetas) {
for (let i = 0; i < etiquetas.length; i++) {
    etiquetas[i].style.display = 'none';
}
}

function mostrarEtiquetas(etiquetas) {
for (let i = 0; i < etiquetas.length; i++) {
    etiquetas[i].style.display = 'block';
}
}

function enviarDatos() {
var tipo_data = $("#tipo").val();
var competencia1Seleccionada = false;
var competencia2Seleccionada = false;
var competencia3Seleccionada = false;
// Recopilar los datos
var Validation1 = document.querySelectorAll('input[name="competencia_1"]');
var Validation2 = document.querySelectorAll('input[name="competencia_2"]');
var Validation3 = document.querySelectorAll('input[name="competencia_3"]');

Validation1.forEach(function(Validatio) {
    if (Validatio.checked) {
        competencia1Seleccionada = true;
    }
});

Validation2.forEach(function(Validatio) {
    if (Validatio.checked) {
        competencia2Seleccionada = true;
    }
});

Validation3.forEach(function(Validatio) {
    if (Validatio.checked) {
        competencia3Seleccionada = true;
    }
});

if (tipo_data === "1" || tipo_data === "2") {
    if (competencia1Seleccionada === false || competencia2Seleccionada === false || competencia3Seleccionada ===
        false) {
        alert('No olvides evaluar TODAS las competencias');
        return false;
    }
}


var datos = {
    iniciativa_codigo: $("#iniciativa_codigo").val(),
    tipo_data: $("#tipo").val(),
    conocimiento_1_data: $("input[name='conocimiento_1_SINO_1']:checked").val(),
    conocimiento_2_data: $("input[name='conocimiento_2_SINO']:checked").val(),
    conocimiento_3_data: $("input[name='conocimiento_3_SINO']:checked").val(),
    cumplimiento_1_data: $("input[name='cumplimiento_1']:checked").val(),
    cumplimiento_2_data: $("input[name='cumplimiento_2']:checked").val(),
    cumplimiento_3_data: $("input[name='cumplimiento_3']:checked").val(),
    calidad_1_data: $("input[name='calidad_1']:checked").val(),
    calidad_2_data: $("input[name='calidad_2']:checked").val(),
    calidad_3_data: $("input[name='calidad_3']:checked").val(),
    calidad_4_data: $("input[name='calidad_4']:checked").val(),
    competencia_1_data: $("input[name='competencia_1']:checked").val(),
    competencia_2_data: $("input[name='competencia_2']:checked").val(),
    competencia_3_data: $("input[name='competencia_3']:checked").val(),
};

$.ajax({
    type: "GET",
    url: window.location.origin + '/admin/iniciativas/evaluar',
    data: datos,
    headers: {
        'X-CSRF-TOKEN': token
    },
    success: function(response) {
        /* Mostrar Formulario */

        /* Ocultar Tabla */
        var MostrarTabla = document.getElementById("AllTable");
        MostrarTabla.style.display = "none";

        var alerta = document.getElementById("exito_crear");
        alerta.style.display = "block";

        reiniciarRadios();

        $("#puntaje_obtenido").val("");
        setTimeout(function() {
            alerta.style.display = "none";
        }, 2000);
    },
    error: function(error) {
        console.error(error);
        /* $('.alert-container').hide();
        $('#error').show(); */
    }
});
}

function enviarEval() {
var tipo_data = $("#tipo").val();
// Recopilar los datos

var datos = {
    iniciativa_codigo: $("#iniciativa_codigo").val(),
    tipo_data: $("#ingresar").val(),
    puntaje: $("#puntaje_obtenido").val(),
};

$.ajax({
    type: "GET",
    url: window.location.origin + '/admin/iniciativas/ingresoEvaluacion',
    data: datos,
    headers: {
        'X-CSRF-TOKEN': token
    },
    success: function(response) {
        /* Mostrar Formulario */
        console.log(response);
        /* Ocultar Tabla */
        var MostrarTabla = document.getElementById("AllTable");
        MostrarTabla.style.display = "none";

        var alerta = document.getElementById("exito_ingresar");
        alerta.style.display = "block";
        $("#puntaje_obtenido").val("");



        setTimeout(function() {
            alerta.style.display = "none";
        }, 2000);

    },
    error: function(error) {
        console.error(error);
    }
});
}
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
            }else if (tipo == 3) {
                document.getElementById('EstudiantesBloque').style.display = 'none';
                document.getElementById('botonesdeAbajo').style.display = 'block';
                document.getElementById('DocentesBloque').style.display = 'none';
                document.getElementById('ExternosBloque').style.display = 'none';
                document.getElementById('TituladosBloque').style.display = 'block';
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
