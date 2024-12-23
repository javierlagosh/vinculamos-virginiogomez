{{-- EVALUACION EXTERNOS --}}
<div id="form-externos" style="margin-top: 25px">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4>Evaluación externa</h4>
                </div>
                <div class="card-body">
                    <form id="wizard_with_validation" method="POST">
                        {{-- ----------- --}}
                        {{-- PRIMER PASO --}}
                        {{-- ----------- --}}
                        <h3>CONOCIMIENTO DE LA INICIATIVA</h3>
                        <fieldset>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                    </thead>
                                    <tbody id="tabla-Conocimiento-1">
                                        <tr>
                                            <th>¿Sabía usted que el propósito de ésta actividad
                                                era?</th>
                                            <th>¿Sí o No?</th>
                                            {{-- <th>¿En qué % cree usted que se cumplió el objetivo? --}}
                                            </th>
                                        </tr>
                                        {{-- ----------------------------- --}}
                                        {{-- RECORRER PROPOSITOS ESPERADOS --}}
                                        {{-- ----------------------------- --}}
                                        @for ($i = 3; $i <= 5; $i++)
                                            <tr>
                                                <td>
                                                    {{-- Proposito de la iniciativa --}}
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_1_SINO_{{ $i }}"  id="ext_conocimiento_1_SINO_{{ $i }}_si" value="SI" checked>
                                                            <label class="form-check-label" for="ext_conocimiento_1_SINO_{{ $i }}_si"> SI </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_1_SINO_{{ $i }}" id="ext_conocimiento_1_SINO_{{ $i }}_no" value="NO">>
                                                            <label class="form-check-label"  for="ext_conocimiento_1_SINO_{{ $i }}_no">  NO </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tbody id="tabla-Conocimiento-2">
                                        <tr>
                                            <th>¿Sabía usted que los resultados esperados de la actividad eran?</th>
                                            <th>¿Sí o No?</th>
                                            {{-- <th>¿En qué % cree usted que se cumplió el resultado esperado?</th> --}}
                                        </tr>

                                        {{-- ----------------------------- --}}
                                        {{-- RECORRER RESULTADOS ESPERADOS --}}
                                        {{-- ----------------------------- --}}
                                        @for ($i = 3; $i <= 5; $i++)
                                            <tr>
                                                <td>
                                                    {{-- Objetivo de la iniciativa --}}
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_2_SINO_{{ $i }}"  id="ext_conocimiento_2_SINO_{{ $i }}_si" value="SI" checked>
                                                            <label class="form-check-label" for="ext_conocimiento_2_SINO_{{ $i }}"> SI </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_2_SINO_{{ $i }}" id="ext_conocimiento_2_SINO_{{ $i }}_no" value="NO" >
                                                            <label class="form-check-label"  for="ext_conocimiento_2_SINO_{{ $i }}_no">  NO </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tbody id="tabla-Conocimiento-3">
                                        <tr>
                                            <th>¿Sabía usted que las contribuciones esperadas eran?</th>
                                            <th>¿Sí o No?</th>
                                            {{-- <th>¿En qué % cree usted que se cumplirán las contribuciones?</th> --}}
                                        </tr>

                                        {{-- ----------------------------- --}}
                                        {{-- RECORRER RESULTADOS ESPERADOS --}}
                                        {{-- ----------------------------- --}}
                                        @for ($i = 6; $i <= 7; $i++)
                                            <tr>
                                                <td>
                                                    {{-- Objetivo de la iniciativa --}}
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_3_SINO_{{ $i }}"  id="ext_conocimiento_3_SINO_{{ $i }}_si" checked>
                                                            <label class="form-check-label" for="ext_conocimiento_3_SINO_{{ $i }}_si"> SI </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_3_SINO_{{ $i }}" id="ext_conocimiento_3_SINO_{{ $i }}_no" >
                                                            <label class="form-check-label"  for="ext_conocimiento_3_SINO_{{ $i }}_no">  NO </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>


                        </fieldset>

                        {{-- ----------------- --}}
                        {{-- Cumplimiento PASO --}}
                        {{-- ----------------- --}}

                        <h3>CUMPLIMIENTO DE LA INICIATIVA</h3>
                        <fieldset>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                    </thead>
                                    <tbody id="tabla-Conocimiento-1">
                                        <tr>
                                            <th>Objetivo</th>
                                            <th>¿En qué % cree usted que se cumplió el objetivo?</th>
                                        </tr>
                                        {{-- ----------------------------- --}}
                                        {{-- RECORRER PROPOSITOS ESPERADOS --}}
                                        {{-- ----------------------------- --}}
                                        @for ($i = 3; $i <= 5; $i++)
                                            <tr>
                                                <td>
                                                    {{-- Proposito de la iniciativa --}}
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_1_{{ $i }}" id="ext_conocimiento_1_{{ $i }}_0" value="0" checked>
                                                            <label class="form-check-label" for="ext_conocimiento_1_{{ $i }}_0"> No se cumplió </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_1_{{ $i }}" id="ext_conocimiento_1_{{ $i }}_25" value="25">
                                                            <label class="form-check-label" for="ext_conocimiento_1_{{ $i }}_25"> 25 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_1_{{ $i }}" id="ext_conocimiento_1_{{ $i }}_50" value="50">
                                                            <label class="form-check-label" for="ext_conocimiento_1_{{ $i }}_50"> 50 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_1_{{ $i }}" id="ext_conocimiento_1_{{ $i }}_75" value="75">
                                                            <label class="form-check-label" for="ext_conocimiento_1_{{ $i }}_75"> 75 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline"> 
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_1_{{ $i }}" id="ext_conocimiento_1_{{ $i }}_100" value="100">
                                                            <label class="form-check-label" for="ext_conocimiento_1_{{ $i }}_100"> 100 % </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tbody id="tabla-Conocimiento-2">
                                        <tr>
                                            <th>Objetivo</th>
                                            <th>¿En qué % cree usted que se cumplió el resultado esperado?</th>
                                        </tr>

                                        {{-- ----------------------------- --}}
                                        {{-- RECORRER RESULTADOS ESPERADOS --}}
                                        {{-- ----------------------------- --}}
                                        @for ($i = 3; $i <= 5; $i++)
                                            <tr>
                                                <td>
                                                    {{-- Objetivo de la iniciativa --}}
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_2_{{ $i }}" id="ext_conocimiento_2_{{ $i }}_0" value="0" checked>
                                                            <label class="form-check-label" for="ext_conocimiento_2_{{ $i }}_0"> No se cumplió </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_2_{{ $i }}" id="ext_conocimiento_2_{{ $i }}_25" value="25">
                                                            <label class="form-check-label" for="ext_conocimiento_2_{{ $i }}_25"> 25 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_2_{{ $i }}" id="ext_conocimiento_2_{{ $i }}_50" value="50">
                                                            <label class="form-check-label" for="ext_conocimiento_2_{{ $i }}_50"> 50 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_2_{{ $i }}" id="ext_conocimiento_2_{{ $i }}_75" value="75">
                                                            <label class="form-check-label" for="ext_conocimiento_2_{{ $i }}_75"> 75 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline"> 
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_2_{{ $i }}" id="ext_conocimiento_2_{{ $i }}_100" value="100">
                                                            <label class="form-check-label" for="ext_conocimiento_2_{{ $i }}_100"> 100 % </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tbody id="tabla-Conocimiento-3">
                                        <tr>
                                            <th>Objetivo</th>
                                            <th>¿En qué % cree usted que se cumplirán las contribuciones?</th>
                                        </tr>

                                        {{-- ----------------------------- --}}
                                        {{-- RECORRER RESULTADOS ESPERADOS --}}
                                        {{-- ----------------------------- --}}
                                        @for ($i = 6; $i <= 7; $i++)
                                            <tr>
                                                <td>
                                                    {{-- Objetivo de la iniciativa --}}
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_3_{{ $i }}" id="ext_conocimiento_3_{{ $i }}_0" value="0" checked>
                                                            <label class="form-check-label" for="ext_conocimiento_3_{{ $i }}_0"> No se cumplió </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_3_{{ $i }}" id="ext_conocimiento_3_{{ $i }}_25" value="25">
                                                            <label class="form-check-label" for="ext_conocimiento_3_{{ $i }}_25"> 25 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_3_{{ $i }}" id="ext_conocimiento_3_{{ $i }}_50" value="50">
                                                            <label class="form-check-label" for="ext_conocimiento_3_{{ $i }}_50"> 50 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_3_{{ $i }}" id="ext_conocimiento_3_{{ $i }}_75" value="75">
                                                            <label class="form-check-label" for="ext_conocimiento_3_{{ $i }}_75"> 75 % </label>
                                                        </div>
                                                        <div class="form-check form-check-inline"> 
                                                            <input class="form-check-input" type="radio" name="ext_conocimiento_3_{{ $i }}" id="ext_conocimiento_3_{{ $i }}_100" value="100">
                                                            <label class="form-check-label" for="ext_conocimiento_3_{{ $i }}_100"> 100 % </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>

                        {{-- ------------ --}}
                        {{-- SEGUNDO PASO --}}
                        {{-- ------------ --}}

                        <h3>CALIDAD DE LA EJECUCIÓN</h3>
                        <fieldset>
                            <label>A continuación le pedimos que evalúe de 0 a 3 la calidad en la ejecución de la actividad, según los compromisos asumidos por la institución, en que: 
                                <br>
                                <br>0= no cumple. 
                                <br>1= cumple mínimamente.
                                <br>2= cumple medianamente.
                                <br>3= cumple totalmente.
                                <br>
                                <br>Si considera que algunos ítemes no extaban comprometidos, marque <b>No Aplica.</b> </label>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                    </thead>
                                    <tbody id="tabla-calidad-1">
                                        <tr>
                                            <th>Cumplimiento</th>
                                        </tr>
                                        @for ($i = 1; $i <= 4; $i++)
                                            <tr>
                                                @if ($i === 1)
                                                    <td>
                                                        Plazo y horarios
                                                    </td>
                                                @endif
                                                @if ($i === 2)
                                                    <td>
                                                        Equipamiento y/o infraextructura
                                                    </td>
                                                @endif
                                                @if ($i === 3)
                                                    <td>
                                                        Conexión Digital y/ logística
                                                    </td>
                                                @endif
                                                @if ($i === 4)
                                                    <td>
                                                        Presentación y/o desarrollo de la actividad
                                                    </td>
                                                @endif
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_calidad_{{ $i }}"  id="ext_calidad_{{ $i }}_0" >
                                                            <label class="form-check-label" for="ext_calidad_{{ $i }}_0"> 0 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_calidad_{{ $i }}" id="ext_calidad_{{ $i }}_1" >
                                                            <label class="form-check-label"  for="ext_calidad_{{ $i }}_1"> 1 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_calidad_{{ $i }}" id="ext_calidad_{{ $i }}_2" >
                                                            <label class="form-check-label"  for="ext_calidad_{{ $i }}_2"> 2 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_calidad_{{ $i }}" id="ext_calidad_{{ $i }}_3" >
                                                            <label class="form-check-label"  for="ext_calidad_{{ $i }}_3"> 3 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_calidad_{{ $i }}" id="ext_calidad_{{ $i }}_NO" checked>
                                                            <label class="form-check-label"  for="ext_calidad_{{ $i }}_NO"> No Aplica </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>


                        </fieldset>

                        {{-- ----------- --}}
                        {{-- TERCER PASO --}}
                        {{-- ----------- --}}

                        <h3>COMPETENCIA DE extDIANTES</h3>
                        <fieldset>
                            <label>Le pedimos a continuación que evalúe de 0 a 3, competencia para la ejecución de él o los extdiantes, en que: 
                                <br>
                                <br>0= dimensión desarrollada. 
                                <br>1= mínimamente desarrollada.
                                <br>2= medianamente desarrollada.
                                <br>3= completamente desarrollada.
                                <br>
                                <br>Si considera que alguna de las dimensiones no pudo observarlas, marque No Aplica.</label>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        </thead>
                                        <tbody id="tabla-competencia-1">
                                            <tr>
                                                <th>Te sirvió la actividad para desarrollar algunas de las siguientes dimensiones de las competencias comprometidas?</th>
                                                <th>Cumplimiento</th>
                                            </tr>

                                            {{-- ----------------------------- --}}
                                            {{-- RECORRER RESULTADOS ESPERADOS --}}
                                            {{-- ----------------------------- --}}
                                            @for ($i = 1; $i <= 3; $i++)
                                                <tr>
                                                    @if ($i === 1)
                                                    <td>
                                                        Capacidad para ejecutar las actividades.	
                                                    </td>
                                                    @endif
                                                    @if ($i === 2)
                                                    <td>
                                                        Actitud positiva para ejecutar actividades.	
                                                    </td>
                                                    @endif
                                                    @if ($i === 3)
                                                    <td>
                                                        Habilidad para resolver problemas.	
                                                    </td>
                                                    @endif
                                                    <td>
                                                    <div class="form-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_competencia_{{ $i }}"  id="ext_competencia_{{ $i }}_0" >
                                                            <label class="form-check-label" for="ext_competencia_{{ $i }}_0"> 0 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_competencia_{{ $i }}" id="ext_competencia_{{ $i }}_1" >
                                                            <label class="form-check-label"  for="ext_competencia_{{ $i }}_1"> 1 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_competencia_{{ $i }}" id="ext_competencia_{{ $i }}_2" >
                                                            <label class="form-check-label"  for="ext_competencia_{{ $i }}_2"> 2 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_competencia_{{ $i }}" id="ext_competencia_{{ $i }}_3" >
                                                            <label class="form-check-label"  for="ext_competencia_{{ $i }}_3"> 3 </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ext_competencia_{{ $i }}" id="ext_competencia_{{ $i }}_NO" checked>
                                                            <label class="form-check-label"  for="ext_competencia_{{ $i }}_NO"> No Aplica </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>