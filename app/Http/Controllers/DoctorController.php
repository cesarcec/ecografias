<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Rol;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    #WEB
    public function getIndex()
    {
        return view('ecografias.doctor.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::where('estado', 1)->with('user')->get();
        return ApiResponse::success(DoctorResource::collection($doctors), 'Lista obtenida correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $response = [];
        try {

            // Crear doctor
            $doctor = Doctor::create([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'genero' => $request->get('genero'),
                'especialidad' => $request->get('especialidad'),
            ]);

            // Valor por defecto de la contraseña en caso que esté vacía
            $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');

            // Crear usuario
            $user = User::create([
                'name' => $doctor->nombre . ' ' . $doctor->paterno,
                'email' => $request->get('email'),
                'password' => Hash::make($passwordRequest),
            ]);

            // Asignar rol al usuario
            $rol = Rol::where('nombre', 'Doctor')->firstOrFail();
            $user->update(['rol_id' => $rol->id]);

            // Relacionar doctor y usuario
            $doctor->update(['user_id' => $user->id]);
            $doctor->load('user'); // Cargar la relación

            DB::commit();
            $response = ApiResponse::success(new DoctorResource($doctor), 'Registro insertado correctamente.', Response::HTTP_CREATED);
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
        $doctor = Doctor::findOrFail($id);
        return ApiResponse::success(new DoctorResource($doctor), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        $response = [];
        try {

            $doctor = Doctor::findOrFail($id);
            $doctor->update([
                'nombre' => $request->get('nombre'),
                'paterno' => $request->get('paterno'),
                'materno' => $request->get('materno'),
                'genero' => $request->get('genero'),
                'especialidad' => $request->get('especialidad'),
            ]);

            $user = User::where('id', $doctor->user_id)->first();
            $user->email = $request->get('user_email');
            if ($request->has('password') && $request->get('password') != 'undefined') {
                $passwordRequest = $request->get('password') == "" ? "123" : $request->get('password');
                $user->password = Hash::make($passwordRequest);
            }
            $user->save();
            
            $doctor->load('user');
            
            DB::commit();
            $response = ApiResponse::success(new DoctorResource($doctor), 'Registro actualizado correctamente.');
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
        $doctor = Doctor::findOrFail($id);
        $doctor->update(['estado' => 0]);
        return ApiResponse::success(new DoctorResource($doctor), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update(['estado' => 1]);
        return ApiResponse::success(new DoctorResource($doctor), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $doctors = Doctor::where('estado', 0)->get();
        return ApiResponse::success(DoctorResource::collection($doctors), 'Lista de deshabilitados obtenida correctamente');
    }
}