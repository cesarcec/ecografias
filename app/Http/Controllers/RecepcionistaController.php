<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recepcionista;
use App\Models\User;
use App\Models\Rol;
use App\Http\Resources\RecepcionistaResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RecepcionistaController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.recepcionista.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Recepcionista::where('estado', 1)->with('user')->get();
        return ApiResponse::success(RecepcionistaResource::collection($doctors), 'Lista obtenida correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $response = [];
        try {

            $recepcionista = Recepcionista::create([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'genero' => $request->get('genero'),
            ]);

            $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');

            $user = User::create([
                'name' => $recepcionista->nombre . ' ' . $recepcionista->paterno,
                'email' => $request->get('email'),
                'password' => Hash::make($passwordRequest),
            ]);

            $rol = Rol::where('nombre', 'Recepcionista')->firstOrFail();
            $user->update(['rol_id' => $rol->id]);

            $recepcionista->update(['user_id' => $user->id]);
            $recepcionista->load('user');

            DB::commit();
            $response = ApiResponse::success(new RecepcionistaResource($recepcionista), 'Registro insertado correctamente.', Response::HTTP_CREATED);
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
        $recepcionista = Recepcionista::findOrFail($id);
        return ApiResponse::success(new RecepcionistaResource($recepcionista), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $recepcionista = Recepcionista::findOrFail($id);
            $recepcionista->update([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'genero' => $request->get('genero'),
            ]);

            $user = User::where('id', $recepcionista->user_id)->first();
            $user->email = $request->get('user_email');
            if ($request->has('password') && $request->get('password') != 'undefined') {
                $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');
                $user->password = Hash::make($passwordRequest);
            }
            $user->save();
            
            $recepcionista->load('user');
            
            DB::commit();
            $response = ApiResponse::success(new RecepcionistaResource($recepcionista), 'Registro actualizado correctamente.');
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
        $recepcionista = Recepcionista::findOrFail($id);
        $recepcionista->update(['estado' => 0]);
        return ApiResponse::success(new RecepcionistaResource($recepcionista), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $recepcionista = Recepcionista::findOrFail($id);
        $recepcionista->update(['estado' => 1]);
        return ApiResponse::success(new RecepcionistaResource($recepcionista), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $doctors = Recepcionista::where('estado', 0)->get();
        return ApiResponse::success(RecepcionistaResource::collection($doctors), 'Lista de deshabilitados obtenida correctamente');
    }
}