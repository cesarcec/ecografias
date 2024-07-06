<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdenExamen;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\Doctor;
use App\Models\Estudio;
use App\Http\Resources\OrdenExamenResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class OrdenExamenController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.orden_examen.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordenes = OrdenExamen::where('estado', 1)->with('paciente', 'recepcionista', 'doctor', 'estudio')->get();
        $relaciones = [
            'paciente' => Paciente::where('estado', 1)->get(),
            'recepcionista' => Recepcionista::where('estado', 1)->get(),
            'doctor' => Doctor::where('estado', 1)->get(),
            'estudio' => Estudio::where('estado', 1)->get(),
        ];
        $response = ApiResponse::success(OrdenExamenResource::collection($ordenes), 'Lista obtenida correctamente', 200, $relaciones);
       
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $response = [];
        try {

            $orden = OrdenExamen::create([
                'fecha_cita' => $request->get('fecha_cita'),
                'fecha_programada' => $request->get('fecha_programada'),
                'hora_inicio' => $request->get('hora_inicio'),
                'hora_fin' => $request->get('hora_fin'),
                'estado_orden' => $request->get('estado_orden'),
                'paciente_id' => $request->get('paciente_id'),       
                'recepcionista_id' => $request->get('recepcionista_id'),       
                'doctor_id' => $request->get('doctor_id'),       
                'estudio_id' => $request->get('estudio_id'),       
            ]);
            $orden->load('paciente', 'recepcionista', 'doctor', 'estudio');

            DB::commit();
            $response = ApiResponse::success(new OrdenExamenResource($orden), 'Registro insertado correctamente.', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ApiResponse::error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orden = OrdenExamen::findOrFail($id);
        return ApiResponse::success(new OrdenExamenResource($orden), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $orden = OrdenExamen::findOrFail($id);
            $orden->update([
                'fecha_cita' => $request->get('fecha_cita'),
                'fecha_programada' => $request->get('fecha_programada'),
                'hora' => $request->get('hora'),
                'estado_orden' => $request->get('estado_orden'),
                'paciente_id' => $request->get('paciente_id'),       
                'recepcionista_id' => $request->get('recepcionista_id'),       
                'doctor_id' => $request->get('doctor_id'),       
                'estudio_id' => $request->get('estudio_id'),       
            ]);
            $orden->load('paciente', 'recepcionista', 'doctor', 'estudio');
            
            DB::commit();
            $response = ApiResponse::success(new OrdenExamenResource($orden), 'Registro actualizado correctamente.');
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
        $orden = OrdenExamen::findOrFail($id);
        $orden->update(['estado' => 0]);
        return ApiResponse::success(new OrdenExamenResource($orden), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $orden = OrdenExamen::findOrFail($id);
        $orden->update(['estado' => 1]);
        return ApiResponse::success(new OrdenExamenResource($orden), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $ordenes = OrdenExamen::where('estado', 0)->get();
        return ApiResponse::success(OrdenExamenResource::collection($ordenes), 'Lista de deshabilitados obtenida correctamente');
    }

    //Generación de pdf
    public function generarComprobantePDF(string $id)
    {
        $orden = OrdenExamen::findOrFail($id);
        $orden->load('paciente', 'doctor', 'recepcionista', 'estudio');
        $data = [
            'orden' => $orden
        ];

        $pdf = PDF::loadView('ecografias.orden_examen.comprobante', $data);
        return $pdf->stream('comprobante.pdf');
    }
}