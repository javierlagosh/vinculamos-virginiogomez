@extends('admin.panel')

@section('contenido')
<section class="section" style="font-size: 115%;">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Listado de Objetivos de Desarrollo Sostenible</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @for ($i = 1; $i <= 17; $i++)
                            <a class="btn">
                                <img alt="image" src="{{ asset('/img/ods/' . $i . '.png') }}" width="150">
                            </a>
                            @endfor
                            <a class="btn">
                                <img alt="image" src="{{ asset('/img/ods/0.png') }}" width="150">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="{{ asset('/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/page/datatables.js') }}"></script>
@endsection
