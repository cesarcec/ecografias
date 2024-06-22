<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEstudio;

class TipoEstudioController extends Controller
{
     #WEB
     public function getIndex() {
        return view('ecografias.tipo_estudio.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_estudio = TipoEstudio::where('estado', 1)->get();;
        return ['data' => $tipo_estudio, 'status' => 200];
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
        $tipo_estudio = TipoEstudio::create([
            'nombre' => $request->get('nombre'),
        ]);

        return ['data' => $tipo_estudio, 'status' => 200];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipo_estudio = TipoEstudio::findOrFail($id);
        return ['data' => $tipo_estudio, 'status' => 200];
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
        $tipo_estudio = TipoEstudio::findOrFail($id);
        $tipo_estudio->update([
            'nombre' => $request->get('nombre')
        ]);
        return ['data' => $tipo_estudio, 'status' => 200];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipo_estudio = TipoEstudio::findOrFail($id);
        $tipo_estudio->update([
            'estado' => 0
        ]);
        return ['data' => $tipo_estudio, 'status' => 200];
    }

    public function restore(string $id)
    {
        $tipo_estudio = TipoEstudio::findOrFail($id);
        $tipo_estudio->update([
            'estado' => 1
        ]);
        return ['data' => $tipo_estudio, 'status' => 200];
    }

    public function disabled()
    {
        $tipo_estudio = TipoEstudio::where('estado', 0)->get();
        return ['data' => $tipo_estudio, 'status' => 200];
    }
}
