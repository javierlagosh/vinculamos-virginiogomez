@extends('layout.index')

@section('acceso')
    <ul class="sidebar-menu" style="font-size: 110%;">
        <li class="dropdown">
            <a href="{{ route('dashboard.ver') }}" class="nav-link">
                <i data-feather="home" id="saludo"></i><span>Inicio</span></a>
        </li>

        @if (Session::has('admin'))
            <li class="menu-header fas fa-cog"> Administrador/a </li>
            <li
                class="{{ Route::is('admin.iniciativa.listar') || Route::is('admin.inicitiativas.crear.primero')
                    ? 'dropdown active'
                    : 'dropdown' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="book-open"></i><span>Actividades</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.iniciativa.listar') }}">Listado de
                            actividades</a></li>
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.inicitiativas.crear.primero') }}">Crear actividad</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="clipboard"></i><span>Bitácora</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.actividades') }}">Reuniones</a></li>
                    {{-- <li><a style="font-size: 90%;" class="nav-link" href="{{route('admin.listar.donaciones')}}">Listar donación</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{route('admin.ingresar.donaciones')}}">Ingresar donación</a></li> --}}
                </ul>
            </li>

            <li
                class="{{ Route::is('admin.listar.sedes') ||
                Route::is('admin.listar.escuelas') ||
                Route::is('admin.listar.ambitos') ||
                Route::is('admin.listar.ambitosaccion') ||
                Route::is('admin.listar.programas') ||
                Route::is('admin.listar.convenios') ||
                Route::is('admin.listar.socios') ||
                Route::is('admin.listar.mecanismos') ||
                Route::is('admin.listar.grupos_int') ||
                Route::is('admin.listar.subgrupos') ||
                Route::is('admin.listar.tipoact') ||
                Route::is('admin.listar.rrhh') ||
                Route::is('admin.listar.tipoinfra') ||
                Route::is('admin.listar.tipounidad') ||
                Route::is('admin.listar.unidades') ||
                Route::is('admin.listar.ccostos') ||
                Route::is('admin.listar.subunidades')
                    ? 'dropdown active'
                    : 'dropdown' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="command"></i><span>Parámetros</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.sedes') }}">Sedes</a></li>
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.escuelas') }}">Escuelas/Unidades</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.carreras') }}">Carreras</a>
                    </li>
                    {{-- <li><a style="font-size: 90%;" class="nav-link" href="{{route("admin.listar.carreras")}}">Carreras</a></li> --}}
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.ambitos') }}">Contribución</a></li>
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.ambitosaccion') }}">Ambitos
                            Acción</a></li>
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.programas') }}">Programas</a></li>
                    <li style="padding-bottom: 1px;line-height: 15px;margin-top:5px;"><a style="font-size: 90%;"
                            class="nav-link" href="{{ route('admin.listar.convenios') }}">Documento de colaboración</a>
                    </li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.socios') }}">Socios
                            Comunitarios</a></li>
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.mecanismos') }}">Mecanismos</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.grupos_int') }}">Grupos de
                            interés</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.subgrupos') }}">Sub-Grupos
                            de interés</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.tipoact') }}">Tipos de
                            iniciativa</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.ccostos') }}">Centro de
                            costos</a></li>
                    {{-- <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.rrhh') }}">Tipos de
                            RRHH</a></li> --}}
                    {{-- <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.tipoinfra') }}">Tipos de
                            Infraestructuras</a></li> --}}
                    {{-- <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.tipounidad') }}">Tipos de --}}
                    {{-- Unidades</a></li> --}}
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.unidades') }}">Unidades</a></li>
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.subunidades') }}">SubUnidades</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.valores') }}">Valores</a>
                    </li>
                    {{-- <li><a style="font-size: 90%;" class="nav-link" href="{{route("admin.listar.tematica")}}">Tematicas</a></li> --}}
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Usuarios</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.listar.usuarios') }}">Listado de
                            usuarios</a></li>
                </ul>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="star"></i><span>Objetivos</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link" href="{{route("admin.listar.ods")}}">ODS</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="bar-chart-2"></i><span>Análisis de datos</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="arrow-left-circle"></i><span>Extracción de datos</span></a>
            </li> --}}
        @elseif (Session::has('digitador'))
            <li class="menu-header fas fa-cog">Digitador/a</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="book-open"></i><span>Actividades</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link" href="{{ route('admin.iniciativa.listar') }}">Listado
                            de actividades</a></li>
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.inicitiativas.crear.primero') }}">Crear actividad</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="clipboard"></i><span>Bitácora</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('admin.listar.actividades') }}">Reuniones</a></li>
                    {{-- <li><a style="font-size: 90%;" class="nav-link" href="{{route('admin.listar.donaciones')}}">Listar donación</a></li>
                    <li><a style="font-size: 90%;" class="nav-link" href="{{route('admin.ingresar.donaciones')}}">Ingresar donación</a></li> --}}
                </ul>
            </li>
        @elseif (Session::has('observador'))
            <li class="menu-header fas fa-cog">Observador/a</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="book-open"></i><span>Actividades</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('observador.iniciativa.listar') }}">Listado de actividades</a></li>
                </ul>
            </li>
        @elseif (Session::has('supervisor'))
            <li class="menu-header fas fa-cog">Supervisor/a</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="book-open"></i><span>Actividades</span></a>
                <ul class="dropdown-menu">
                    <li><a style="font-size: 90%;" class="nav-link"
                            href="{{ route('supervisor.iniciativa.listar') }}">Listado de actividades</a></li>
                </ul>
            </li>
        @endif
        @if (Session::has('admin') || Session::has('digitador'))
            <li class="dropdown">
                <a href="{{ route('descargamasiva.ver') }}" class="nav-link"><i
                        data-feather="download"></i><span>Descarga masiva</span></a>
            </li>
        @endif


    @endsection

    @section('contenido')
