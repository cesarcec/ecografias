<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\OrdenExamen;
use App\Models\Sala;
use App\Http\Resources\ExamenResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    #WEB
    public function getRealizarExamen(string $id)
    {
        $orden = OrdenExamen::findOrfail($id); 
        $orden->load('paciente', 'doctor');
        return view('ecografias.examen.index', ['orden' => $orden]);
    }

    public function getIndex()
    {
   
        return view('ecografias.examen.examenes');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examenes = Examen::where('estado', 1)
            ->with('ordenExamen.doctor.user', 'ordenExamen.paciente.user', 'sala')
            ->get();
        $salas = ['salas' => Sala::where('estado', 1)->get()];
        $response = ApiResponse::success(ExamenResource::collection($examenes), 'Lista obtenida correctamente', 200, $salas);
       
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

            $examen = Examen::create([
                'observaciones' => $request->get('observaciones'),
                'fecha' => $request->get('fecha'),
                'precio' => $request->get('precio'),
                'orden_examen_id' => $request->get('orden_examen_id'),       
                'sala_id' => $request->get('sala_id'),       
            ]);

            $orden = OrdenExamen::findOrFail($examen->orden_examen_id);
            $orden->update(["estado_orden" => "Examen realizado"]);
            $examen->load('ordenExamen.doctor.user', 'ordenExamen.paciente.user', 'ordenExamen.recepcionista.user', 'ordenExamen.estudio', 'sala');


            DB::commit();
            $response = ApiResponse::success(new ExamenResource($examen), 'Registro insertado correctamente.', Response::HTTP_CREATED);
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
        $examen = Examen::findOrFail($id);
        return ApiResponse::success(new ExamenResource($examen), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $examen = Examen::findOrFail($id);
            $examen->update([
                'observaciones' => $request->get('observaciones'),
                'fecha' => $request->get('fecha'),
                'precio' => $request->get('precio'),
                'orden_examen_id' => $request->get('orden_examen_id'),       
                'sala_id' => $request->get('sala_id'),          
            ]);
            $examen->load('ordenExamen.doctor', 'ordenExamen.paciente', 'ordenExamen.recepcionista', 'ordenExamen.estudio', 'sala');
            
            DB::commit();
            $response = ApiResponse::success(new ExamenResource($examen), 'Registro actualizado correctamente.');
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
        $examen = Examen::findOrFail($id);
        $examen->update(['estado' => 0]);
        return ApiResponse::success(new ExamenResource($examen), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $examen = Examen::findOrFail($id);
        $examen->update(['estado' => 1]);
        return ApiResponse::success(new ExamenResource($examen), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $examenes = Examen::where('estado', 0)->with('ordenExamen.doctor.user', 'ordenExamen.paciente.user', 'sala')->get();
        return ApiResponse::success(ExamenResource::collection($examenes), 'Lista de deshabilitados obtenida correctamente');
    }
}