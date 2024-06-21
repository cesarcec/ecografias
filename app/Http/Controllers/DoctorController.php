<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorModel;
use App\Http\Resources\DoctorResource;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponse    ;

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
        $doctors = DoctorModel::where('estado', 1)->get();
        return ApiResponse::success(DoctorResource::collection($doctors), 'Lista obtenida correctamente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $doctor = DoctorModel::create($request->all());
        return ApiResponse::success(new DoctorResource($doctor), 'Registro insertado correctamente.', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = DoctorModel::findOrFail($id);
        return ApiResponse::success(new DoctorResource($doctor), 'Registro encontrado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = DoctorModel::findOrFail($id);
        $doctor->update($request->all());
        return ApiResponse::success(new DoctorResource($doctor), 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = DoctorModel::findOrFail($id);
        $doctor->update(['estado' => 0]);
        return ApiResponse::success(new DoctorResource($doctor), 'Registro deshabilitado correctamente.');
    }

    public function restore(string $id)
    {
        $doctor = DoctorModel::findOrFail($id);
        $doctor->update(['estado' => 1]);
        return ApiResponse::success(new DoctorResource($doctor), 'Registro restaurado correctamente.');
    }

    public function disabled()
    {
        $doctors = DoctorModel::where('estado', 0)->get();
        return ApiResponse::success(DoctorResource::collection($doctors), 'Lista de deshabilitados obtenida correctamente');
    }
}