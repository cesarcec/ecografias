<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecepcionistaModel;

class RecepcionistaController extends Controller
{
     #WEB
     public function getIndex() {
        return view('ecografias.recepcionista.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recepcionista = RecepcionistaModel::all();
        return ['data' => $recepcionista, 'status' => 200];
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
        $recepcionista = RecepcionistaModel::create([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
<<<<<<< HEAD
            'materno' => $request->get('materno'),
=======
            'materno' => $request->get('paterno'),
>>>>>>> 13baf7e0f59c2be5981a4ef7a4191028ba2bdcb8
            'genero' => $request->get('genero'),
        ]);

        return ['data' => $recepcionista, 'status' => 200];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recepcionista = RecepcionistaModel::findOrFail($id); 
        return ['data' => $recepcionista, 'status' => 200];
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
        $recepcionista = RecepcionistaModel::findOrFail($id); 
        $recepcionista->update([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
<<<<<<< HEAD
            'materno' => $request->get('materno'),
=======
            'materno' => $request->get('paterno'),
>>>>>>> 13baf7e0f59c2be5981a4ef7a4191028ba2bdcb8
            'genero' => $request->get('genero'),       
        ]);
        return ['data' => $recepcionista, 'status' => 200];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recepcionista = RecepcionistaModel::findOrFail($id); 
        $recepcionista->update([
            'estado' => 0 
        ]);
        return ['data' => $recepcionista, 'status' => 200];
    }

    public function restore(string $id)
    {
        $recepcionista = RecepcionistaModel::findOrFail($id); 
        $recepcionista->update([
            'estado' => 1 
        ]);
        return ['data' => $recepcionista, 'status' => 200];
    }

    public function disabled()
    {
        $recepcionista = RecepcionistaModel::where('estado', 0)->get();
        return ['data' => $recepcionista, 'status' => 200];
    }
}
