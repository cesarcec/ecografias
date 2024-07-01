<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudio;
use App\Models\TipoEstudio;
use App\Http\Resources\EstudioResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EstudioController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.estudio.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudios = Estudio::where('estado', 1)->with('tipoEstudio')->get();
        $tipoEstudios = ['tipo_estudio' => TipoEstudio::where('estado', 1)->get()];
        $response = ApiResponse::success(EstudioResource::collection($estudios), 'Lista obtenida correctamente', 200, $tipoEstudios);
       
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

            $estudio = Estudio::create([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
                'requerimientos' => $request->get('requerimientos'),
                'precio' => $request->get('precio'),
                'tipo_estudio_id' => $request->get('tipo_estudio_id'),       
            ]);
            $estudio->load('tipoEstudio');

            DB::commit();
            $response = ApiResponse::success(new EstudioResource($estudio), 'Registro insertado correctamente.', Response::HTTP_CREATED);
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
        $estudio = Estudio::findOrFail($id);
        return ApiResponse::success(new EstudioResource($estudio), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $estudio = Estudio::findOrFail($id);
            $estudio->update([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
                'requerimientos' => $request->get('requerimientos'),
                'precio' => $request->get('precio'),
                'tipo_estudio_id' => $request->get('tipo_estudio_id'),        
            ]);
            $estudio->load('tipoEstudio');
            
            DB::commit();
            $response = ApiResponse::success(new EstudioResource($estudio), 'Registro actualizado correctamente.');
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
        $estudio = Estudio::findOrFail($id);
        $estudio->update(['estado' => 0]);
        return ApiResponse::success(new EstudioResource($estudio), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $estudio = Estudio::findOrFail($id);
        $estudio->update(['estado' => 1]);
        return ApiResponse::success(new EstudioResource($estudio), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $estudios = Estudio::where('estado', 0)->get();
        return ApiResponse::success(EstudioResource::collection($estudios), 'Lista de deshabilitados obtenida correctamente');
    }
}