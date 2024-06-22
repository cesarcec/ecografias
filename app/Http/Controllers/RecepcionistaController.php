<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recepcionista;

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
        $recepcionista = Recepcionista::where('estado', 1)->get();;
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
        $recepcionista = Recepcionista::create([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
            'materno' => $request->get('materno'),
            'genero' => $request->get('genero'),
        ]);

        return ['data' => $recepcionista, 'status' => 200];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recepcionista = Recepcionista::findOrFail($id); 
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
        $recepcionista = Recepcionista::findOrFail($id); 
        $recepcionista->update([
            'nombre' => $request->get('nombre'),
            'paterno' => $request->get('paterno'),
            'materno' => $request->get('materno'),
            'genero' => $request->get('genero'),       
        ]);
        return ['data' => $recepcionista, 'status' => 200];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recepcionista = Recepcionista::findOrFail($id); 
        $recepcionista->update([
            'estado' => 0 
        ]);
        return ['data' => $recepcionista, 'status' => 200];
    }

    public function restore(string $id)
    {
        $recepcionista = Recepcionista::findOrFail($id); 
        $recepcionista->update([
            'estado' => 1 
        ]);
        return ['data' => $recepcionista, 'status' => 200];
    }

    public function disabled()
    {
        $recepcionista = Recepcionista::where('estado', 0)->get();
        return ['data' => $recepcionista, 'status' => 200];
    }
}
