<?php

namespace App\Http\Controllers;

use App\Models\Escuelas;
use App\Models\Iniciativas;
use App\Models\IniciativasComunas;
use App\Models\IniciativasParticipantes;
use App\Models\ParticipantesInternos;
use App\Models\Sedes;
use App\Models\SociosComunitarios;
use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function Index() {
        $nIniciativas = Iniciativas::select('inic_codigo')->distinct()->get();
        $nEstudiantes = ParticipantesInternos::select(DB::raw('SUM(COALESCE(pain_estudiantes_final,0)) as estudiantes'))->get();
        $nDocentes = ParticipantesInternos::select(DB::raw('SUM(COALESCE(pain_docentes_final,0)) as docentes'))->get();
        $nSocios = SociosComunitarios::all();
        $nBeneficiarios = IniciativasParticipantes::select(DB::raw('SUM(COALESCE(inpr_total_final,0)) as beneficiarios'))->get();
        $nTitulados = IniciativasParticipantes::select(DB::raw('SUM(COALESCE(inpr_total_final,0)) as titulados'))->where('soco_codigo', 15)->get();

        $comunas = IniciativasComunas::select('comu_codigo')->distinct()->get();
        $sedes = Sedes::select('sede_codigo', 'sede_nombre')->orderBy('sede_nombre', 'asc')->get();
        $escuelas = Escuelas::select('escu_codigo', 'escu_nombre')->orderBy('escu_nombre', 'asc')->get();
        

        return view(
            'admin.dashboard',
            compact(
                'nIniciativas',
                'nEstudiantes',
                'nDocentes',
                'nSocios',
                'nBeneficiarios',
                'comunas',
                'sedes',
                'escuelas',
            )
        );
    }
    public function descargaMasiva()
    {
        return view('admin.descarga-masiva');
    }

    public function sedesDatos(Request $request)
    {

        if ($request->sede_codigo == 'all') {
            $sede = ParticipantesInternos::select(
                DB::raw('SUM(COALESCE(pain_docentes_final,0)) as total_docentes'),
                DB::raw('SUM(COALESCE(pain_estudiantes_final,0)) as total_estudiantes'),
                DB::raw('COUNT(DISTINCT(inic_codigo)) as total_iniciativas')
            )
                ->get();

            $sede_meta = Sedes::select(
                DB::raw('SUM(COALESCE(sede_meta_estudiantes,0)) as meta_estudiantes'),
                DB::raw('SUM(COALESCE(sede_meta_docentes,0)) as meta_docentes'),
                DB::raw('SUM(COALESCE(sede_meta_iniciativas,0)) as meta_iniciativas')
            )->get();

            $sede_subgrupos_interes = ParticipantesInternos::leftjoin('iniciativas', 'iniciativas.inic_codigo', 'participantes_internos.inic_codigo')
                ->leftjoin('iniciativas_participantes', 'iniciativas_participantes.inic_codigo', 'iniciativas.inic_codigo')
                ->leftjoin('sub_grupos_interes', 'sub_grupos_interes.sugr_codigo', 'iniciativas_participantes.sugr_codigo')
                ->select(DB::raw('DISTINCT(iniciativas_participantes.inic_codigo)'), 'sub_grupos_interes.sugr_nombre')
                ->get();

            $sede_grupos_interes = ParticipantesInternos::join('iniciativas', 'iniciativas.inic_codigo', 'participantes_internos.inic_codigo')
                ->leftjoin('iniciativas_participantes', 'iniciativas_participantes.inic_codigo', 'iniciativas.inic_codigo')
                ->leftjoin('sub_grupos_interes', 'sub_grupos_interes.sugr_codigo', 'iniciativas_participantes.sugr_codigo')
                ->leftjoin('grupos_interes', 'grupos_interes.grin_codigo', 'sub_grupos_interes.grin_codigo')
                ->select(DB::raw('DISTINCT(sub_grupos_interes.sugr_codigo)'), 'grupos_interes.grin_nombre')
                ->get();

            $sede_iniciativas_estados = Iniciativas::select('inic_estado')->get();

            $sede_iniciativas_años = Iniciativas::select('inic_anho')->get();

            $sede_iniciativas_comunas = IniciativasComunas::join('comunas', 'comunas.comu_codigo', 'iniciativas_comunas.comu_codigo')
                ->select('comunas.comu_nombre')
                ->orderBy('comunas.comu_nombre')
                ->get();



            return response()->json([$sede, $sede_meta, $sede_subgrupos_interes, $sede_grupos_interes, $sede_iniciativas_estados, $sede_iniciativas_años, $sede_iniciativas_comunas]);
        } else {
            $sede = ParticipantesInternos::select(
                DB::raw('SUM(COALESCE(pain_docentes_final,0)) as total_docentes'),
                DB::raw('SUM(COALESCE(pain_estudiantes_final,0)) as total_estudiantes'),
                DB::raw('COUNT(DISTINCT(inic_codigo)) as total_iniciativas')
            )
                ->whereIn('sede_codigo', [$request->sede_codigo, 10])
                ->get();

            $sede_meta = Sedes::select(
                DB::raw('SUM(COALESCE(sede_meta_estudiantes,0)) as meta_estudiantes'),
                DB::raw('SUM(COALESCE(sede_meta_docentes,0)) as meta_docentes'),
                DB::raw('SUM(COALESCE(sede_meta_iniciativas,0)) as meta_iniciativas')
            )
                ->where('sede_codigo', $request->sede_codigo)
                ->get();

            $sede_subgrupos_interes = ParticipantesInternos::join('iniciativas', 'iniciativas.inic_codigo', 'participantes_internos.inic_codigo')
                ->join('iniciativas_participantes', 'iniciativas_participantes.inic_codigo', 'iniciativas.inic_codigo')
                ->join('sub_grupos_interes', 'sub_grupos_interes.sugr_codigo', 'iniciativas_participantes.sugr_codigo')
                ->select(DB::raw('DISTINCT(iniciativas_participantes.inic_codigo)'), 'sub_grupos_interes.sugr_nombre')
                ->where('participantes_internos.sede_codigo', $request->sede_codigo)
                ->get();

            $sede_grupos_interes = ParticipantesInternos::join('iniciativas', 'iniciativas.inic_codigo', 'participantes_internos.inic_codigo')
                ->join('iniciativas_participantes', 'iniciativas_participantes.inic_codigo', 'iniciativas.inic_codigo')
                ->join('sub_grupos_interes', 'sub_grupos_interes.sugr_codigo', 'iniciativas_participantes.sugr_codigo')
                ->join('grupos_interes', 'grupos_interes.grin_codigo', 'sub_grupos_interes.grin_codigo')
                ->select(DB::raw('DISTINCT(sub_grupos_interes.sugr_codigo)'), 'grupos_interes.grin_nombre')
                ->where('participantes_internos.sede_codigo', $request->sede_codigo)
                ->get();

            $sede_iniciativas_estados = Iniciativas::join('participantes_internos', 'participantes_internos.inic_codigo', 'iniciativas.inic_codigo')
                ->select('inic_estado')
                ->where('participantes_internos.sede_codigo', $request->sede_codigo)
                ->get();

            $sede_iniciativas_años = Iniciativas::join('participantes_internos', 'participantes_internos.inic_codigo', 'iniciativas.inic_codigo')
                ->select('inic_anho')
                ->where('participantes_internos.sede_codigo', $request->sede_codigo)
                ->get();

            $sede_iniciativas_comunas = IniciativasComunas::join('iniciativas', 'iniciativas.inic_codigo', 'iniciativas_comunas.inic_codigo')
                ->join('participantes_internos', 'participantes_internos.inic_codigo', 'iniciativas.inic_codigo')
                ->join('comunas', 'comunas.comu_codigo', 'iniciativas_comunas.comu_codigo')
                ->select('comunas.comu_nombre')
                ->where('participantes_internos.sede_codigo', $request->sede_codigo)
                ->orderBy('comunas.comu_nombre')
                ->get();

            return response()->json([$sede, $sede_meta, $sede_subgrupos_interes, $sede_grupos_interes, $sede_iniciativas_estados, $sede_iniciativas_años, $sede_iniciativas_comunas]);
        }
    }
}
