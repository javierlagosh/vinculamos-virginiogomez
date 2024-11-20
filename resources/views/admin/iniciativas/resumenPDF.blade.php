<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Iniciativas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #C8102E; /* Rojo Brillante */
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .initiative-section {
            page-break-after: always;
        }
        .initiative-title {
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 15px;
            color: #232F60;
            border-bottom: 2px solid #E7C412; 
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 30px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #232F60; /* Azul Oscuro */
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        tr:hover {
            background-color: #e8f4ff; /* Azul Claro */
        }
        td:first-child {
            font-weight: bold;
            color: #232F60; /* Azul Oscuro */
        }
        .cover {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            page-break-after: always;
            text-align: center;
        }
        .cover h1 {
            color: #858387;
        }
        .cover img {
            max-width: 550px;
            height: auto;
        }
    </style>
    
</head>
<body>
    <div class="cover">
        <h1>Resumen de Iniciativas</h1>
        <br><br><br><br>
        <img src="https://ipvirginiogomez.vinculamos.org/img/logos/logo_vg_color.png" alt="AIEP Logo">
        <br>
        <br>
        <br>
        <img src="https://vinculamos.cl/assets/imgs/logo.svg" alt="vinculamos logo" class="logo">
    </div>

    <div class="container">
        @foreach($iniciativas as $iniciativa)
            <div class="initiative-section">
                <div class="initiative-title">Iniciativa ID {{ $iniciativa->inic_codigo }}: {{ $iniciativa->inic_nombre }}</div>
                <table>
                    <tbody>
                        <tr>
                            <th>Descripción</th>
                            <td>{{ $iniciativa->inic_descripcion }}</td>
                        </tr>
                        <tr>
                            <th>Región</th>
                            <td>
                                {{ $iniciativa->regiones ?? "Sin regiones especificadas" }}</td>
                            </td>
                        </tr>
                        <tr>
                            <th>Comuna</th>
                            <td>
                                {{ $iniciativa->comunas ?? "Sin comunas especificadas" }}</td>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha</th>
                            <td>
                                @if ($iniciativa->fecha_inicio)
                                    <strong>Inicio:</strong> {{ $iniciativa->fecha_inicio_formateada }}
                                @else
                                    <strong>Inicio:</strong> No especificada aún 
                                @endif
                                @if ($iniciativa->fecha_ejecucion)
                                    <br><strong>Ejecución:</strong> {{ $iniciativa->fecha_ejecucion_formateada }}
                                @else
                                    <br><strong>Ejecución:</strong> No especificada aún
                                @endif
                                @if ($iniciativa->fecha_cierre)
                                    <br><strong>Termino:</strong> {{ $iniciativa->fecha_cierre_formateada }}
                                @else
                                    <br><strong>Termino:</strong> No especificada aún
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Unidades ejecutoras</th>
                            <td>
                                {{ $iniciativa->unidadesEjecutoras ?? "Sin unidades ejecutoras especificadas" }}</td>
                            </td>
                        </tr>

                        <tr>
                            <th>Socios Comunitarios</th>
                            <td>
                                {{ $iniciativa->socioComunitario ?? "Sin Socios comunitarios especificados" }}</td>
                            </td>
                        </tr>


                        <tr>
                            <th>Mecanismo</th>
                            <td>{{ $iniciativa->meca_nombre ?? "Sin mecanismo especificado" }}</td>
                        </tr>
                        <tr>
                            <th>Programa</th>
                            <td>{{ $iniciativa->prog_nombre ?? "Sin programa especificado" }}</td>
                        </tr>
                        <tr>
                            <th>Tipo de actividad</th>
                            <td>{{ $iniciativa->tiac_nombre ?? "Sin tipo de actividad especificado" }}</td>
                        </tr>
                        <tr>
                            <th>Convenio</th>
                            <td>{{ $iniciativa->conv_nombre ?? "Sin convenio asociado" }}</td>
                        </tr>

                        <tr>
                            <th>Formato</th>
                            <td>{{ $iniciativa->inic_formato ?? "Sin formato asociado" }}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>
                                @if ($iniciativa->inic_estado == 0)
                                    En revisión
                                @elseif ($iniciativa->inic_estado == 1)
                                    En revisión
                                @elseif ($iniciativa->inic_estado == 2)
                                    En ejecución
                                @elseif ($iniciativa->inic_estado == 3)
                                    Aceptada
                                @elseif ($iniciativa->inic_estado == 4)
                                    Falta información
                                @elseif ($iniciativa->inic_estado == 5)
                                    Cerrada
                                @elseif ($iniciativa->inic_estado == 6)
                                    Finalizada
                                @endif

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</body>
</html>
