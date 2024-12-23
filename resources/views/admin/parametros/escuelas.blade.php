@extends('admin.panel')

@section('contenido')
    <section class="section" style="font-size: 115%;">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            @if ($errors->has('nombre') || $errors->has('director'))
                                <div class="alert alert-warning alert-dismissible show fade mb-4 text-center">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        @if ($errors->has('nombre'))
                                            <strong>{{ $errors->first('nombre') }}</strong><br>
                                        @endif
                                        @if ($errors->has('director'))
                                            <strong>{{ $errors->first('director') }}</strong><br>
                                        @endif

                                    </div>
                                </div>
                            @endif
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
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Listado de escuelas y unidades</h4>
                            <div class="card-header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalCrearEscuela"><i class="fas fa-plus"></i> Nueva Escuela/Unidad</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1" style="font-size: 110%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            {{-- <th>Carreras</th> --}}
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        ?>
                                        @foreach ($escuelas as $escu)
                                            <?php
                                            $contador = $contador + 1;
                                            ?>
                                            <tr>
                                                <td>{{ $contador }}</td>
                                                <td>{{ $escu->escu_nombre }}</td>
                                                {{-- <td>{{ $escu->escu_carreras }}</td> --}}
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-warning"
                                                        onclick="editarEscu({{ $escu->escu_codigo }})" data-toggle="tooltip"
                                                        data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-danger"
                                                        onclick="eliminarEscu({{ $escu->escu_codigo }})"
                                                        data-toggle="tooltip" data-placement="top" title="Eliminar"><i
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

    <div class="modal fade" id="modalCrearEscuela" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Nueva Escuela/Unidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.crear.escuelas') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nombre de la Escuela/Unidad</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-pen-nib"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder=""
                                    autocomplete="off">
                                @if ($errors->has('nombre'))
                                    <div class="alert alert-warning alert-dismissible show fade mt-2 text-center"
                                        style="width:100%">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Director/a</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="director" name="director" placeholder=""
                                    autocomplete="off">
                                @if ($errors->has('director'))
                                    <div class="alert alert-warning alert-dismissible show fade mt-2 text-center"
                                        style="width:100%">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            <strong>{{ $errors->first('director') }}</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
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
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Meta Iniciativas</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" id="meta_iniciativas"
                                            name="meta_iniciativas" value="0"
                                            autocomplete="off">
                                    </div>
                                    @error('meta_iniciativas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Meta Docentes</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" id="meta_docentes"
                                            name="meta_docentes" value="0" autocomplete="off">
                                    </div>
                                    @error('meta_docentes')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Meta Titulados</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" id="meta_titulados"
                                            name="meta_titulados" value="0"
                                            autocomplete="off">
                                    </div>
                                    @error('meta_titulados')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Meta Estudiantes</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" id="meta_externos"
                                            name="meta_externos" value="0" autocomplete="off">
                                    </div>
                                    @error('meta_externos')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($escuelas as $escu)
        <div class="modal fade" id="modalEditarEscuela-{{ $escu->escu_codigo }}" tabindex="-1" role="dialog"
            aria-labelledby="modalEditarEscuela" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarEscuela">Editar Escuela/Unidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.actualizar.escuelas', $escu->escu_codigo) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label>Nombre de la Escuela/Unidad</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-pen-nib"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="escu_nombre" name="escu_nombre"
                                        value="{{ $escu->escu_nombre }}" autocomplete="off">
                                </div>
                            </div>
                            
                            {{-- <div class="form-group">
                                <label>Descripción de la escuela</label>
                                <div class="input-group">
                                    <textarea rows="6" class="formbold-form-input" id="descripcion" name="descripcion" autocomplete="off"
                                    style="width:100%">{{ $escu->escu_descripcion }}</textarea>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label>Director/a</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="escu_director" name="escu_director"
                                        value="{{ $escu->escu_director }}" autocomplete="off">
                                </div>
                            </div>
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
                                            @foreach ($SedeEscuelas as $sedees)
                                                @if ($sedees->sede_codigo === $sede->sede_codigo && $sedees->escu_codigo === $escu->escu_codigo)
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
                            <div class="row">
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Meta Iniciativas</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" id="meta_iniciativas"
                                                name="meta_iniciativas" value="{{ $escu->meta_iniciativas }}"
                                                autocomplete="off">
                                        </div>
                                        @error('meta_iniciativas')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Meta Docentes</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" id="meta_docentes"
                                                name="meta_docentes" value="{{ $escu->meta_docentes }}" autocomplete="off">
                                        </div>
                                        @error('meta_docentes')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Meta Titulados</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" id="meta_titulados"
                                                name="meta_titulados" value="{{ $escu->meta_titulados }}"
                                                autocomplete="off">
                                        </div>
                                        @error('meta_titulados')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Meta Estudiantes</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" id="meta_externos"
                                                name="meta_externos" value="{{ $escu->meta_externos }}" autocomplete="off">
                                        </div>
                                        @error('meta_externos')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary waves-effect">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modalEliminarEscuela" tabindex="-1" role="dialog" aria-labelledby="modalEliminar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.eliminar.escuelas') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminar">Eliminar unidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-ban text-danger" style="font-size: 50px; color"></i>
                        <h6 class="mt-2">La unidad dejará de existir dentro del sistema. <br> ¿Desea continuar de todos
                            modos?</h6>
                        <input type="hidden" id="escu_codigo" name="escu_codigo" value="">
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
        function eliminarEscu(escu_codigo) {
            $('#escu_codigo').val(escu_codigo);
            $('#modalEliminarEscuela').modal('show');
        }

        function editarEscu(escu_codigo) {
            $('#modalEditarEscuela-' + escu_codigo).modal('show');
        }
    </script>

    {{-- <link rel="stylesheet" href="{{ asset('/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/page/datatables.js') }}"></script> --}}
@endsection
