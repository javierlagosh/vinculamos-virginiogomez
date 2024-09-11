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
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0</td>
                                    <td>Evaluador interno - Estudiantes</td>
                                    <td><a href="{{ route('admin.ver.evaluacion', [$iniciativa[0]->inic_codigo, 0]) }}"
                                        class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                         <i class="fas fa-eye"></i> Ver resultados de la evaluación </a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Evaluador interno - Docentes/Directivos</td>
                                    <td><a href="{{ route('admin.ver.evaluacion', [$iniciativa[0]->inic_codigo, 1]) }}"
                                        class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                         <i class="fas fa-eye"></i> Ver resultados de la evaluación </a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Evaluador externo</td>
                                    <td><a href="{{ route('admin.ver.evaluacion', [$iniciativa[0]->inic_codigo, 2]) }}"
                                        class="btn btn-primary mr-1 waves-effect icon-left" type="button">
                                         <i class="fas fa-eye"></i> Ver resultados de la evaluación </a></td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center"><a href="{{ route('admin.evaluar.iniciativa', $iniciativa[0]->inic_codigo) }}" class="btn btn-primary w-50">Ingresar evaluación</a></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
