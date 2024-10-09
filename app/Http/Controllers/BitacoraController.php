<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use App\Models\ActividadesEvidencias;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BitacoraController extends Controller
{
    private function getUserRole()
    {
        if (Session::has('admin')) {
            return 'admin';
        } elseif (Session::has('digitador')) {
            return 'digitador';
        } elseif (Session::has('observador')) {
            return 'observador';
        } elseif (Session::has('supervisor')) {
            return 'supervisor';
        }
        return null;
    }
    
    //TODO: funciones de actividades
    public function listarActividad()
    {
        $ACTIVIDADES = Actividades::all();
        return view('admin.bitacoras.actividades', compact('ACTIVIDADES'));
    }

    public function crearActividad(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|max:200',
            'fecha' => 'required|date',
            'fecha_cumplimiento' => 'required|date',
            'acuerdos' => 'required',
        ], [
            'nombre.required' => 'El nombre de la actividad es requerido.',
            'nombre.max' => 'El nombre de la actividad excede el máximo de caracteres permitidos (100).',
            'fecha.required' => 'La fecha de creación es requerida.',
            'fecha.date' => 'La fecha de creación no tiene un formato válido.',
            'fecha_cumplimiento.required' => 'La fecha de cumplimiento es requerida.',
            'fecha_cumplimiento.date' => 'La fecha de cumplimiento no tiene un formato válido.',
            'acuerdos.required' => 'Los acuerdos son requeridos.',
        ]);

        if ($validacion->fails()) {
            return redirect()->route('admin.listar.actividades')->withErrors($validacion)->withInput();
        }

        $nuevaActividad = new Actividades();
        $nuevaActividad->acti_nombre = $request->input('nombre');
        $nuevaActividad->acti_acuerdos = $request->input('acuerdos');
        $nuevaActividad->acti_avance = $request->input('avance');
        $nuevaActividad->acti_fecha = Carbon::createFromFormat('Y-m-d', $request->input('fecha'));
        $nuevaActividad->acti_fecha_cumplimiento = Carbon::createFromFormat('Y-m-d', $request->input('fecha_cumplimiento'));
        // Otros campos si es necesario
        $nuevaActividad->acti_actualizado = Carbon::now()->format('Y-m-d H:i:s');
        $nuevaActividad->acti_visible = 1;
        $nuevaActividad->acti_nickname_mod = Session::get('admin')->usua_nickname;
        $nuevaActividad->acti_rol_mod = Session::get('admin')->rous_codigo;
        $nuevaActividad->save();

        return redirect()->back()->with('exitoActividades', 'Actividad creada exitosamente');
    }

    public function actualizarActividad(Request $request, $acti_codigo)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|max:200',
            'fecha' => 'required|date',
            'fecha_cumplimiento' => 'required|date',
            'acuerdos' => 'required',
        ], [
            'nombre.required' => 'El nombre de la actividad es requerido.',
            'nombre.max' => 'El nombre de la actividad excede el máximo de caracteres permitidos (100).',
            'fecha.required' => 'La fecha de creación es requerida.',
            'fecha.date' => 'La fecha de creación no tiene un formato válido.',
            'fecha_cumplimiento.required' => 'La fecha de cumplimiento es requerida.',
            'fecha_cumplimiento.date' => 'La fecha de cumplimiento no tiene un formato válido.',
            'acuerdos.required' => 'Los acuerdos son requeridos.',
        ]);

        if ($validacion->fails()) {
            return redirect()->route('admin.listar.actividades')->withErrors($validacion)->withInput();
        }

        $actividad = Actividades::find($acti_codigo);
        if (!$actividad) {
            return redirect()->back()->with('errorActividades', 'La actividad no existe');
        }

        $actividad->acti_nombre = $request->input('nombre');
        $actividad->acti_acuerdos = $request->input('acuerdos');
        $actividad->acti_avance = $request->input('avance');
        $actividad->acti_fecha = Carbon::createFromFormat('Y-m-d', $request->input('fecha'));
        $actividad->acti_fecha_cumplimiento = Carbon::createFromFormat('Y-m-d', $request->input('fecha_cumplimiento'));
        // Otros campos si es necesario
        $actividad->acti_actualizado = Carbon::now()->format('Y-m-d H:i:s');
        $actividad->acti_nickname_mod = Session::get('admin')->usua_nickname;
        $actividad->acti_rol_mod = Session::get('admin')->rous_codigo;
        $actividad->save();

        return redirect()->back()->with('exitoActividades', 'Actividad actualizada exitosamente');
    }

    public function eliminarActividad(Request $request)
    {
        $acti_codigo = $request->input('acti_codigo');

        $actividad = Actividades::find($acti_codigo);
        if (!$actividad) {
            return redirect()->back()->with('errorActividades', 'La actividad no existe');
        }

        $actividad->delete();

        return redirect()->back()->with('exitoActividades', 'Actividad eliminada exitosamente');
    }

    public function listarEvidencias(Request $request)
    {
        $acti_codigo = $request->route('acti_codigo');
        $actividad = Actividades::find($acti_codigo);
        $evidencias = ActividadesEvidencias::where('acti_codigo', $acti_codigo)->get();

        if (!$actividad) {
            return redirect()->back()->with('errorActividades', 'La actividad no existe');
        }

        return view('admin.bitacoras.listar-evidencias', compact('actividad', 'evidencias'));
    }

    public function guardarEvidencia(Request $request, $acti_codigo)
    {
        $role = $this->getUserRole();
        $inicVerificar = Actividades::where('acti_codigo', $acti_codigo)->first();

        if (empty($inicVerificar)) {
            $ThisRuta = "$rolePrefix.listar.actividades";
            return redirect()->route($ThisRuta)->with('errorIniciativa', 'La actividad no se encuentra registrada en el sistema.');
        }

        $validarEntradas = Validator::make(
            $request->all(),
            [
                'actevi_nombre' => 'required|max:50',
                'actevi_archivo' => 'required|max:10000',
            ],
            [
                'actevi_nombre.required' => 'El nombre de la evidencia es requerido.',
                'actevi_nombre.max' => 'El nombre de la evidencia excede el máximo de caracteres permitidos (50).',
                'actevi_archivo.required' => 'El archivo de la evidencia es requerido.',
                'actevi_archivo.mimes' => 'El tipo de archivo no está permitido, intente con un formato de archivo tradicional.',
                'actevi_archivo.max' => 'El archivo excede el tamaño máximo permitido (10 MB).'
            ]
        );

        if (empty($inicVerificar)) {
            $ThisRuta = "$role.listar.evidencias";
            return redirect()->route($ThisRuta)->with('errorEvidencias', 'Error al registrar la evidencia, prueba más tarde.');
        }

        $guardar = ActividadesEvidencias::insertGetId([
            'acti_codigo' => $acti_codigo,
            'actevi_nombre' => $request->actevi_nombre,
            // Todo: nuevo campo a la BD
            'actevi_creado' => Carbon::now('America/Santiago')->format('Y-m-d H:i:s'),
            'actevi_actualizado' => Carbon::now('America/Santiago')->format('Y-m-d H:i:s'),
            'actevi_rol_mod' => Session::get($role)->rous_codigo,
            'actevi_nickname_mod' => Session::get($role)->usua_nickname,
        ]);

        if (!$guardar)
            redirect()->back()->with('errorEvidencia', 'Ocurrió un error al registrar la evidencia, intente más tarde.');

        $archivo = $request->file('actevi_archivo');
        $rutaEvidencia = 'files/actividadesevidencias/' . $guardar;

        if (File::exists(public_path($rutaEvidencia)))
            File::delete(public_path($rutaEvidencia));

        $moverArchivo = $archivo->move(public_path('files/actividadesevidencias'), $guardar);

        if (!$moverArchivo) {
            ActividadesEvidencias::where('actevu_codigo', $guardar)->delete();
            return redirect()->back()->with('errorEvidencia', 'Ocurrió un error al registrar la evidencia, intente más tarde.');
        }

        $actualizar = ActividadesEvidencias::where('actevi_codigo', $guardar)->update([
            'actevi_ruta' => 'files/actividadesevidencias/' . $guardar,
            'actevi_mime' => $archivo->getClientMimeType(),
            'actevi_actualizado' => Carbon::now()->format('Y-m-d H:i:s'),
            'actevi_rol_mod' => Session::get($role)->rous_codigo,
            'actevi_nickname_mod' => Session::get($role)->usua_nickname,
        ]);
        if (!$actualizar)
            return redirect()->back()->with('errorEvidencia', 'Ocurrió un error al registrar la evidencia, intente más tarde.');

        $ThisRuta = 'admin.listar.evidencias';
        return redirect()->route($ThisRuta, $acti_codigo)->with('exitoEvidencia', 'La evidencia fue registrada correctamente.');
    }

    public function actualizarEvidencia(Request $request, $actevi_codigo)
    {
        $role = $this->getUserRole();
        $evidencia = ActividadesEvidencias::where('actevi_codigo', $actevi_codigo)->first();

        if (!$evidencia)
            return redirect()->back()->with('errorEvidencia', 'La evidencia no se encuentra registrada o vigente en el sistema.');

        $validarEntradas = Validator::make(
            $request->all(),
            [
                'actevi_nombre_edit' => 'required|max:50',
            ],
            [
                'actevi_nombre_edit.required' => 'El nombre de la evidencia es requerido.',
                'actevi_nombre_edit.max' => 'El nombre de la evidencia excede el máximo de caracteres permitidos (50).',
            ]
        );

        if ($validarEntradas->fails()) {
            $ThisRuta = "$role.evidencias.listar";
            return redirect()->route($ThisRuta, $evidencia->inic_codigo)->with('errorValidacion', $validarEntradas->errors()->first());
        }

        $inevActualizar = ActividadesEvidencias::where('actevi_codigo', $actevi_codigo)->update([
            'actevi_nombre' => $request->actevi_nombre_edit,
            'actevi_actualizado' => Carbon::now()->format('Y-m-d H:i:s'),
            'actevi_rol_mod' => Session::get($role)->rous_codigo,
            'actevi_nickname_mod' => Session::get($role)->usua_nickname,
        ]);
        if (!$inevActualizar)
            return redirect()->back()->with('errorEvidencia', 'Ocurrió un error al actualizar la evidencia, intente más tarde.');
        
        $ThisRuta = 'admin.listar.evidencias';
        return redirect()->route($ThisRuta, $evidencia->acti_codigo)->with('exitoEvidencia', 'La evidencia fue actualizada correctamente.');
    }

    public function descargarEvidencia($actevi_codigo)
    {
        try {
            $evidencia = ActividadesEvidencias::where('actevi_codigo', $actevi_codigo)->first();
            if (!$evidencia)
                return redirect()->back()->with('errorEvidencia', 'La evidencia no se encuentra registrada o vigente en el sistema.');

            $archivo = public_path($evidencia->actevi_ruta);
            $cabeceras = array(
                'Content-Type: ' . $evidencia->actevi_mime,
                'Cache-Control: no-cache, no-store, must-revalidate',
                'Pragma: no-cache'
            );

            return Response::download($archivo, $evidencia->actevi_nombre, $cabeceras);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('errorEvidencia', 'Ocurrió un problema al descargar la evidencia, intente más tarde.');
        }
    }

    public function eliminarEvidencia($actevi_codigo)
    {
        $role = $this->getUserRole();

        try {
            $evidencia = ActividadesEvidencias::where('actevi_codigo', $actevi_codigo)->first();

            if (!$evidencia)
                return redirect()->back()->with('errorEvidencia', 'La evidencia no se encuentra registrada o vigente en el sistema.');

            if (File::exists(public_path($evidencia->actevi_ruta)))
                File::delete(public_path($evidencia->actevi_ruta));

            $inevEliminar = ActividadesEvidencias::where('actevi_codigo', $actevi_codigo)->delete();
            if (!$inevEliminar)
                return redirect()->back()->with('errorEvidencia', 'Ocurrió un error al eliminar la evidencia, intente más tarde.');
            
            $ThisRuta = $role . '.listar.evidencias';
            return redirect()->route($ThisRuta, $evidencia->acti_codigo)->with('exitoEvidencia', 'La evidencia fue eliminada correctamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorEvidencia', 'Ocurrió un problema al eliminar la evidencia, intente más tarde.');
        }
    }
}
