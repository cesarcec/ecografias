<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Rol;
use App\Http\Resources\PacienteResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.paciente.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::where('estado', 1)->with('user')->get();
        return ApiResponse::success(PacienteResource::collection($pacientes), 'Lista obtenida correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $response = [];
        try {

            $paciente = Paciente::create([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'genero' => $request->get('genero'),
                'fecha_nacimiento' => $request->get('fecha_nacimiento'),       
                'edad' => $request->get('edad'),       
            ]);

            $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');

            $user = User::create([
                'name' => $paciente->nombre . ' ' . $paciente->paterno,
                'email' => $request->get('email'),
                'password' => Hash::make($passwordRequest),
            ]);

            $rol = Rol::where('nombre', 'Paciente')->firstOrFail();
            $user->update(['rol_id' => $rol->id]);

            $paciente->update(['user_id' => $user->id]);
            $paciente->load('user'); 

            Auth::login($user);

            DB::commit();
            $response = ApiResponse::success(new PacienteResource($paciente), 'Registro insertado correctamente.', Response::HTTP_CREATED);
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
        $paciente = Paciente::findOrFail($id);
        return ApiResponse::success(new PacienteResource($paciente), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $paciente = Paciente::findOrFail($id);
            $paciente->update([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'genero' => $request->get('genero'),
                'fecha_nacimiento' => $request->get('fecha_nacimiento'),       
                'edad' => $request->get('edad'),       
            ]);

            $user = User::where('id', $paciente->user_id)->first();
            $user->email = $request->get('user_email');
            if ($request->has('password') && $request->get('password') != 'undefined') {
                $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');
                $user->password = Hash::make($passwordRequest);
            }
            $user->save();
            
            $paciente->load('user');
            
            DB::commit();
            $response = ApiResponse::success(new PacienteResource($paciente), 'Registro actualizado correctamente.');
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
        $paciente = Paciente::findOrFail($id);
        $paciente->update(['estado' => 0]);
        return ApiResponse::success(new PacienteResource($paciente), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->update(['estado' => 1]);
        return ApiResponse::success(new PacienteResource($paciente), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $pacientes = Paciente::where('estado', 0)->get();
        return ApiResponse::success(PacienteResource::collection($pacientes), 'Lista de deshabilitados obtenida correctamente');
    }

    public function citas(string $id) {
        $pacientes = Paciente::findOrFail($id);
        $pacientes->load('ordenExamenes');
        return $pacientes;
    }
}