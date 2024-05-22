<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorModel;

class DoctorController extends Controller
{
     #WEB
     public function getIndex() {
        return view('ecografias.doctor.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor = DoctorModel::all();
        return ['data' => $doctor, 'status' => 200];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $doctor = DoctorModel::create([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
            'materno' => $request->get('paterno'),
            'genero' => $request->get('genero'),
        ]);

        return ['data' => $doctor, 'status' => 200];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = DoctorModel::findOrFail($id); 
        return ['data' => $doctor, 'status' => 200];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = DoctorModel::findOrFail($id); 
        $doctor->update([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
            'materno' => $request->get('paterno'),
            'genero' => $request->get('genero'),       
        ]);
        return ['data' => $doctor, 'status' => 200];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = DoctorModel::findOrFail($id); 
        $doctor->update([
            'estado' => 0 
        ]);
        return ['data' => $doctor, 'status' => 200];
    }

    public function restore(string $id)
    {
        $doctor = DoctorModel::findOrFail($id); 
        $doctor->update([
            'estado' => 1 
        ]);
        return ['data' => $doctor, 'status' => 200];
    }

    public function disabled()
    {
        $doctor = DoctorModel::where('estado', 0)->get();
        return ['data' => $doctor, 'status' => 200];
    }
}
