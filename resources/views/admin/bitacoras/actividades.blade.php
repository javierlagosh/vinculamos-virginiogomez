@extends('admin.panel')

@section('contenido')
<section class="section" style="font-size: 115%;">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        @if (
                            $errors->has('acti_nombre') ||
                            $errors->has('acti_fecha') ||
                            $errors->has('acti_fecha_cumplimiento') ||
                            $errors->has('acti_acuerdos')
                        )
                            <div class="alert alert-warning alert-dismissible show fade mb-4 text-center">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    @foreach(['acti_nombre', 'acti_fecha', 'acti_fecha_cumplimiento', 'acti_acuerdos'] as $field)
                                        @if ($errors->has($field))
                                            <strong>{{ $errors->first($field) }}</strong><br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        @if (Session::has('errorActividades'))
                            <div class="alert alert-danger alert-dismissible show fade mb-4 text-center">
                                <div class="alert-body">
                                    <strong>{{ Session::get('errorActividades') }}</strong>
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('exitoActividades'))
                            <div class="alert alert-success alert-dismissible show fade mb-4 text-center">
                                <div class="alert-body">
                                    <strong>{{ Session::get('exitoActividades') }}</strong>
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-3"></div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Listado de Reuniones</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalCrearactividad"><i class="fas fa-plus"></i> Nueva reunión</button>
                        </div>
                    </div>
                    <style>
                        .wrap-text {
                            white-space: pre-wrap; /* CSS 3 */
                            white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
                            white-space: -pre-wrap; /* Opera 4-6 */
                            white-space: -o-pre-wrap; /* Opera 7 */
                            word-wrap: break-word; /* Internet Explorer 5.5+ */
                            word-break: break-word; /* Forcing line break after a certain number of characters */
                        }
                    </style>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.listar.actividades') }}" class="mb-3">
                            <div class="form-group">
                                <label for="sedeFiltro">Filtrar por Sede:</label>
                                <select name="sede" id="sedeFiltro" class="form-control" onchange="this.form.submit()">
                                    <option value="">Sin filtro</option>
                                    @foreach ($sedesT as $sede)
                                        <option value="{{ $sede->sede_codigo }}" {{ isset($sedeFiltro) && $sedeFiltro == $sede->sede_codigo ? 'selected' : '' }}>
                                            {{ $sede->sede_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" style="font-size: 110%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Acuerdos</th>
                                        <th>Fecha cumplimiento</th>
                                        <th>Sedes</th>
                                        {{-- <th> idcampo1  </th> --}}
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 0; ?>
                                    @foreach ($ACTIVIDADES as $actividad)
                                        <?php $contador = $contador + 1; ?>
                                        <tr>
                                            <td>{{ $contador }}</td>
                                            <td style="width: 20%;">{{ $actividad->acti_nombre }}</td>
                                            <td class="wrap-text">{{ $actividad->acti_acuerdos }}</td>
                                            <td>{{ $actividad->acti_fecha_cumplimiento }}</td>
                                            <td> {{ $actividad->sedes ?? "No se ha proporcionado sede asociada." }} </td>
                                            <td style="width: 15%;">
                                                <a href="javascript:void(0)" class="btn btn-icon btn-warning"
                                                    onclick="editaractividad({{ $actividad->acti_codigo }})" data-toggle="tooltip"
                                                    data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.listar.evidencias', $actividad->acti_codigo) }}" class="btn btn-icon btn-info"
                                                    data-toggle="tooltip" data-placement="top" title="Agregar Evidencias"><i
                                                        class="fas fa-plus"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-icon btn-danger"
                                                    onclick="eliminaractividad({{ $actividad->acti_codigo }})"
                                                    data-toggle="tooltip" data-placement="top" title="Eliminar actividad"><i
                                                        class="fas fa-trash"></i></a>
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

@foreach ($ACTIVIDADES as $actividad)
    <div class="modal fade" id="modaleditaractividad-{{ $actividad->acti_codigo }}" tabindex="-1" role="dialog"
        aria-labelledby="modaleditaractividad" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaleditaractividadto">Editar reunión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.actualizar.actividades', $actividad->acti_codigo) }} " method="POST">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label>Nombre de la reunión</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pen-nib"></i> {{-- ICONO --}}
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="{{ $actividad->acti_nombre }}" autocomplete="off">
                            </div>
                        </div>
                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group" style="align-items: center;" id="sedesAsociadasContainer">
                            <label>Sedes Asociadas</label>
                            <div class="input-group">
                                <select class="form-control select2" style="width: 100%" id="sedesT"
                                    name="sedesT[]" multiple>
                                    <option value="" disabled>Seleccione...</option>
                                    @foreach ($sedesT as $sede)
                                        @php
                                            $selected = false;
                                        @endphp
                                        @foreach ($SedesActividades as $sedees)
                                            @if ($sedees->sede_codigo === $sede->sede_codigo && $sedees->acti_codigo === $actividad->acti_codigo)
                                                @php
                                                    $selected = true;
                                                @endphp
                                            @endif
                                        @endforeach

                                        <option value="{{ $sede->sede_codigo }}" {{ $selected ? 'selected' : '' }}>
                                            {{ $sede->sede_nombre }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sedesT'))
                                    <div class="alert alert-warning alert-dismissible show fade mt-2 text-center"
                                        style="width:100%">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            <strong>{{ $errors->first('sedesT') }}</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Acuerdos</label>
                            <div class="input-group">
                                <textarea class="form-control" id="acuerdos" name="acuerdos" cols="30" rows="10">{{ $actividad->acti_acuerdos }}</textarea>
                            </div>
                        </div>
                        @error('acuerdos')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label>Fecha creación</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pen-nib"></i> {{-- ICONO --}}
                                    </div>
                                </div>
                                <input type="date" class="form-control" id="fecha" name="fecha"
                                    value="{{ $actividad->acti_fecha ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $actividad->acti_fecha)->format('Y-m-d') : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        @error('fecha')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group">
                            <label>Fecha cumplimiento</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pen-nib"></i> {{-- ICONO --}}
                                    </div>
                                </div>
                                <input type="date" class="form-control" id="fecha_cumplimiento" name="fecha_cumplimiento"
                                    value="{{ $actividad->acti_fecha_cumplimiento ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $actividad->acti_fecha_cumplimiento)->format('Y-m-d') : '' }}"
                                    autocomplete="off">
                                </div>
                        </div>
                        @error('fecha_cumplimiento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        
                        <div class="form-group">
                            <label>Avance</label> <label for="" style="color: red;">*</label>
                            @if (isset($actividad))
                                <select class="form-control" id="avance" name="avance">
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="Ejecutada" {{ $actividad->acti_avance=='Ejecutada' ? 'selected' : '' }}>Ejecutada</option>
                                    <option value="En avance conforme a plazo" {{ $actividad->acti_avance=='En avance conforme a plazo' ? 'selected' : '' }}>En avance conforme a plazo</option>
                                    <option value="En avance con retraso" {{ $actividad->acti_avance=='En avance con retraso' ? 'selected' : '' }}>En avance con retraso</option>
                                    <option value="Suspendida" {{ $actividad->acti_avance=='Suspendida' ? 'selected' : '' }}>Suspendida</option>
                                    <option value="Descartada" {{ $actividad->acti_avance=='Descartada' ? 'selected' : '' }}>Descartada</option>
                                </select>
                            @else
                                <select class="form-control" id="avance" name="avance">
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="Ejecutada" {{ old('avance')=='Ejecutada' ? 'selected' : '' }}>Ejecutada</option>
                                    <option value="En avance conforme a plazo" {{ old('avance')=='En avance conforme a plazo' ? 'selected' : '' }}>En avance conforme a plazo</option>
                                    <option value="En avance con retraso" {{ old('avance')=='En avance con retraso' ? 'selected' : '' }}>En avance con retraso</option>
                                    <option value="Suspendida" {{ old('avance')=='Suspendida' ? 'selected' : '' }}>Suspendida</option>
                                    <option value="Descartada" {{ old('avance')=='Descartada' ? 'selected' : '' }}>Descartada</option>
                                </select>
                            @endif
                            @if($errors->has('avance'))
                                <div class="alert alert-warning alert-dismissible show fade mt-2">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <strong>{{ $errors->first('avance') }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @error('avance')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror



                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


<div class="modal fade" id="modalCrearactividad" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Nueva reunión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.crear.actividades') }} " method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nombre de la reunión</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-pen-nib"></i> {{-- ICONO --}}
                                </div>
                            </div>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ old('nombre') }}" autocomplete="off">
                        </div>
                    </div>
                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-group">
                        <label>Sedes Asociadas</label>
                        <div class="input-group">
                            <select class="form-control select2" style="width: 100%" id="sedesT" name="sedesT[]"
                                multiple>
                                <option value="" disabled>Seleccione...</option>
                                @foreach ($sedesT as $sede)
                                    <option value="{{ $sede->sede_codigo }}">{{ $sede->sede_nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('sedesT'))
                                <div class="alert alert-warning alert-dismissible show fade mt-2 text-center"
                                    style="width:100%">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <strong>{{ $errors->first('sedesT') }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Acuerdos</label>
                        <div class="input-group">
                            <textarea class="form-control" id="acuerdos" name="acuerdos" cols="30" rows="10"{{ old('acuerdos') }}></textarea>
                        </div>
                    </div>
                    @error('acuerdos')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label>Fecha creación</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-pen-nib"></i> {{-- ICONO --}}
                                </div>
                            </div>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                value="{{old('fecha')  }}" autocomplete="off">
                        </div>
                    </div>
                    @error('fecha')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-group">
                        <label>Fecha cumplimiento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-pen-nib"></i> {{-- ICONO --}}
                                </div>
                            </div>
                            <input type="date" class="form-control" id="fecha_cumplimiento" name="fecha_cumplimiento"
                                value="{{old('fecha_cumplimiento')   }}" autocomplete="off">
                        </div>
                    </div>
                    @error('fecha_cumplimiento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label>Avance</label> <label for="" style="color: red;">*</label>
                        <div class="input-group">
                            <select class="form-control" id="avance" name="avance">
                                <option value="Ejecutada" {{ old('avance')=='Ejecutada' ? 'selected' : '' }}>Ejecutada</option>
                                <option value="En avance conforme a plazo" {{ old('avance')=='En avance conforme a plazo' ? 'selected' : '' }} selected>En avance conforme a plazo</option>
                                <option value="En avance con retraso" {{ old('avance')=='En avance con retraso' ? 'selected' : '' }}>En avance con retraso</option>
                                <option value="Suspendida" {{ old('avance')=='Suspendida' ? 'selected' : '' }}>Suspendida</option>
                                <option value="Descartada" {{ old('avance')=='Descartada' ? 'selected' : '' }}>Descartada</option>
                            </select>
                            @error('avance')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @error('avance')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary waves-effect">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEliminaactividad" tabindex="-1" role="dialog" aria-labelledby="modalEliminar"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.eliminar.actividades') }} " method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminar">Eliminar Reunión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-ban text-danger" style="font-size: 50px; color"></i>
                    <h6 class="mt-2">La reunión dejará de existir dentro del sistema. <br> ¿Desea continuar de todos
                        modos?</h6>
                    <input type="hidden" id="acti_codigo" name="acti_codigo" value="">
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
    function eliminaractividad(acti_codigo) {
        $('#acti_codigo').val(acti_codigo);
        $('#modalEliminaactividad').modal('show');
    }

    function editaractividad(acti_codigo) {
        $('#modaleditaractividad-' + acti_codigo).modal('show');
    }
</script>


@endsection
