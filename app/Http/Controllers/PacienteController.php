<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;


class PacienteController extends Controller
{
    
    #WEB
    public function getIndex() {
        return view('ecografias.paciente.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paciente = Paciente::where('estado', 1)->get();;
        return ['data' => $paciente, 'status' => 200];
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
        $paciente = Paciente::create([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
            'materno' => $request->get('materno'),
            'genero' => $request->get('genero'),
            'fecha_nacimiento' => $request->get('fecha_nacimiento'),
        ]);

        return ['data' => $paciente, 'status' => 200];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paciente = Paciente::findOrFail($id); 
        return ['data' => $paciente, 'status' => 200];
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
        $paciente = Paciente::findOrFail($id); 
        $paciente->update([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
            'materno' => $request->get('materno'),
            'genero' => $request->get('genero'),
            'fecha_nacimiento' => $request->get('fecha_nacimiento'),       
        ]);
        return ['data' => $paciente, 'status' => 200];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paciente = Paciente::findOrFail($id); 
        $paciente->update([
            'estado' => 0 
        ]);
        return ['data' => $paciente, 'status' => 200];
    }

    public function restore(string $id)
    {
        $paciente = Paciente::findOrFail($id); 
        $paciente->update([
            'estado' => 1 
        ]);
        return ['data' => $paciente, 'status' => 200];
    }

    public function disabled()
    {
        $paciente = Paciente::where('estado', 0)->get();
        return ['data' => $paciente, 'status' => 200];
    }
}

