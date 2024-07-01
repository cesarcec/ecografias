<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repartidor;
use App\Models\User;
use App\Models\Rol;
use App\Http\Resources\RepartidorResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RepartidorController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.repartidor.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repartidores = Repartidor::where('estado', 1)->with('user')->get();
        return ApiResponse::success(RepartidorResource::collection($repartidores), 'Lista obtenida correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $response = [];
        try {

            $repartidor = Repartidor::create([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'telefono' => $request->get('telefono'),
                'licencia_conducir' => $request->get('licencia_conducir'),
            ]);

            $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');

            $user = User::create([
                'name' => $repartidor->nombre . ' ' . $repartidor->paterno,
                'email' => $request->get('email'),
                'password' => Hash::make($passwordRequest),
            ]);

            $rol = Rol::where('nombre', 'Repartidor')->firstOrFail();
            $user->update(['rol_id' => $rol->id]);

            $repartidor->update(['user_id' => $user->id]);
            $repartidor->load('user');

            DB::commit();
            $response = ApiResponse::success(new RepartidorResource($repartidor), 'Registro insertado correctamente.', Response::HTTP_CREATED);
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
        $repartidor = Repartidor::findOrFail($id);
        return ApiResponse::success(new RepartidorResource($repartidor), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $repartidor = Repartidor::findOrFail($id);
            $repartidor->update([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'telefono' => $request->get('telefono'),
                'licencia_conducir' => $request->get('licencia_conducir'),
            ]);

            $user = User::where('id', $repartidor->user_id)->first();
            $user->email = $request->get('user_email');
            if ($request->has('password') && $request->get('password') != 'undefined') {
                $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');
                $user->password = Hash::make($passwordRequest);
            }
            $user->save();
            
            $repartidor->load('user');
            
            DB::commit();
            $response = ApiResponse::success(new RepartidorResource($repartidor), 'Registro actualizado correctamente.');
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
        $repartidor = Repartidor::findOrFail($id);
        $repartidor->update(['estado' => 0]);
        return ApiResponse::success(new RepartidorResource($repartidor), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $repartidor = Repartidor::findOrFail($id);
        $repartidor->update(['estado' => 1]);
        return ApiResponse::success(new RepartidorResource($repartidor), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $repartidores = Repartidor::where('estado', 0)->get();
        return ApiResponse::success(RepartidorResource::collection($repartidores), 'Lista de deshabilitados obtenida correctamente');
    }
}