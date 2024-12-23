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
                            @foreach (['errorEvidencia', 'exitoEvidencia', 'errorValidacion', 'errorTipo'] as $sessionKey)
                                @if (Session::has($sessionKey))
                                    <div
                                        class="alert {{ in_array($sessionKey, ['errorEvidencia', 'errorTipo']) ? 'alert-danger' : (in_array($sessionKey, ['exitoEvidencia', 'errorValidacion']) ? 'alert-success' : 'alert-warning') }} alert-dismissible show fade mb-4 text-center">
                                        <div class="alert-body">
                                            <strong>{{ Session::get($sessionKey) }}</strong>
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="col-3"></div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $actividad->acti_nombre }} - Listado de evidencias</h4>
                            <div class="card-header-action">
                                <div class="dropdown d-inline">
                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="agregar()"><i
                                            class="fas fa-plus"></i> Nueva evidencia</a>
                                    <a href="{{ route('admin.listar.actividades') }}"
                                        class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                        <i class="fas fa-angle-left"></i> Volver a listado
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <!-- <th>Archivo original</th> -->
                                            <th>Modificado por</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evidencias as $evidencia)
                                            <tr>
                                                <td>{{ $evidencia->actevi_nombre }}</td>
                                                <!-- <td>{{ $evidencia->actevi_nombre_origen }}</td> -->
                                                <td>{{ $evidencia->actevi_nickname_mod }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route($role . '.actividad.descargar', $evidencia->actevi_codigo) }}"
                                                        method="POST" style="display: inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-icon btn-primary"
                                                            data-toggle="tooltip" data-placement="top" title="Descargar"><i
                                                                class="fas fa-download"></i></button>
                                                    </form>
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-warning"
                                                        onclick="editar({{ $evidencia->actevi_codigo }}, '{{ $evidencia->actevi_nombre }}')"
                                                        data-toggle="tooltip" data-placement="top" data-placement="top"
                                                        title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route($role . '.eliminar.evidenciaactividad', $evidencia->actevi_codigo) }}"
                                                        method="POST" style="display: inline-block">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-icon btn-danger"
                                                            data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
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

    <div class="modal fade" id="modalAgregarEvidencia" tabindex="-1" role="dialog" aria-labelledby="agregarEvidencia"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarEvidencia">Nueva evidencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.crear.evidenciaactividad', $actividad->acti_codigo) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nombre</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="actevi_nombre" name="actevi_nombre"
                                    placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Archivo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                            </div>
                            <input type="file" id="actevi_archivo" name="actevi_archivo"
                                ><br>
                            <small>Tamaño máximo de archivo: 10 MB</small>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect"><i class="fas fa-save"></i>
                                Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarEvidencia" tabindex="-1" role="dialog" aria-labelledby="editarEvidencia" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarEvidencia">Editar evidencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-editar-evidencia">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Nombre</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="actevi_nombre_edit" name="actevi_nombre_edit"
                                    placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect"><i class="fas fa-undo-alt"></i> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/admin/bitacora/evidencias.js') }}"></script>
@endsection
