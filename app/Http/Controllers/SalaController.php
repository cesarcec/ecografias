<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sala;
use App\Http\Resources\SalaResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SalaController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.sala.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudios = Sala::where('estado', 1)->get();
        return ApiResponse::success(SalaResource::collection($estudios), 'Lista obtenida correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $response = [];
        try {

            $sala = Sala::create([
                'nombre' => $request->get('nombre'),    
            ]);

            DB::commit();
            $response = ApiResponse::success(new SalaResource($sala), 'Registro insertado correctamente.', Response::HTTP_CREATED);
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
        $sala = Sala::findOrFail($id);
        return ApiResponse::success(new SalaResource($sala), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $sala = Sala::findOrFail($id);
            $sala->update([
                'nombre' => $request->get('nombre'),      
            ]);
            
            DB::commit();
            $response = ApiResponse::success(new SalaResource($sala), 'Registro actualizado correctamente.');
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
        $sala = Sala::findOrFail($id);
        $sala->update(['estado' => 0]);
        return ApiResponse::success(new SalaResource($sala), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $sala = Sala::findOrFail($id);
        $sala->update(['estado' => 1]);
        return ApiResponse::success(new SalaResource($sala), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $estudios = Sala::where('estado', 0)->get();
        return ApiResponse::success(SalaResource::collection($estudios), 'Lista de deshabilitados obtenida correctamente');
    }
}