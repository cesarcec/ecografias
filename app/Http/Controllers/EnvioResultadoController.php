<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoEstudio;
use App\Http\Resources\EnvioResultadoResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use App\Models\EnvioResultado;
use App\Models\Ubicacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EnvioResultadoController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.envio.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $envios = EnvioResultado::where('estado', 1)->with('ubicacion', 'resultado', 'repartidor')->get();
        // $tipoEstudios = ['tipo_estudio' => TipoEstudio::where('estado', 1)->get()];
        $response = ApiResponse::success(EnvioResultadoResource::collection($envios), 'Lista obtenida correctamente', 200);

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
            Estados de los envios:
                Solicitado
                Confirmado
                Entregado
                Cancelado
        */

        DB::beginTransaction();
        $response = [];
        try {

            $ubicacion = Ubicacion::create([
                'latitud' => $request->get('latitud'),
                'longitud' => $request->get('longitud'),
                'referencia' => $request->get('referencia'),
            ]);

            $fecha_actual = now()->format('Y/m/d');

            $envio = EnvioResultado::create([
                // 'fecha' => $request->get('fecha'),
                'fecha' => $fecha_actual,
                'estado_envio' => 'Solicitado',
                'resultado_id' => $request->get('resultado_id'),
                'ubicacion_id' => $ubicacion->id,
                'repartidor_id' => $request->get('repartidor_id'),
            ]);
            $envio->load('resultado', 'ubicacion', 'repartidor');

            DB::commit();
            $response = ApiResponse::success(new EnvioResultadoResource($envio), 'Registro insertado correctamente.', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ApiResponse::error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function envioPaciente(string $paciente_id)
    {
        $envio = EnvioResultado::select('envio_resultado.*')
                                ->join('resultado', 'envio_resultado.resultado_id', 'resultado.id')
                                ->join('examen', 'resultado.examen_id', 'examen.id')
                                ->join('orden_examen', 'examen.orden_examen_id', 'orden_examen.id')
                                ->where('orden_examen.paciente_id',  $paciente_id)
                                ->get();
        $envio->load('ubicacion', 'repartidor', 'resultado');
        return ApiResponse::success(new EnvioResultadoResource($envio), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $envio = EnvioResultado::findOrFail($id);
            $ubicacion = Ubicacion::findOrFail($envio->ubicacion_id);
            $ubicacion->update([
                'latitud' => $request->get('latitud'),
                'longitud' => $request->get('longitud'),
                'referencia' => $request->get('referencia'),
            ]);

            $fecha_actual = now()->format('Y/m/d');
            $envio->update([
                 'fecha' => $request->get('fecha'),
                 'estado_envio' => $request->get('estado_envio'),
                 'resultado_id' => $request->get('resultado_id'),
                 'ubicacion_id' => $ubicacion->id,
                 'repartidor_id' => $request->get('repartidor_id'),    
            ]);
            $envio->load('resultado', 'ubicacion', 'repartidor');

            DB::commit();
            $response = ApiResponse::success(new EnvioResultadoResource($envio), 'Registro actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ApiResponse::error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $envio = EnvioResultado::findOrFail($id);
        $envio->update(['estado' => 0]);
        return ApiResponse::success(new EnvioResultadoResource($envio), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $envio = EnvioResultado::findOrFail($id);
        $envio->update(['estado' => 1]);
        return ApiResponse::success(new EnvioResultadoResource($envio), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $envios = EnvioResultado::where('estado', 0)->get();
        return ApiResponse::success(EnvioResultadoResource::collection($envios), 'Lista de deshabilitados obtenida correctamente');
    }

    public function pendiente()
    {
        $envioResultados = EnvioResultado::where('estado', 1)->get();
        //return $envioResultado;
        return view('ecografias.envio_resultado.pendiente', compact('envioResultados'));
    }
}
