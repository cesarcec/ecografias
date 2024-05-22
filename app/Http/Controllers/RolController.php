<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolModel;

class RolController extends Controller
{

    #WEB
    public function getIndex() {
        return view('ecografias.roles.index');
    }

    #API REST

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = RolModel::all();
        return ['data' => $roles, 'status' => 200];
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
        $rol = RolModel::create([
            'nombre' => $request->get('nombre'),
        ]);

        return ['data' => $rol, 'status' => 200];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rol = RolModel::findOrFail($id); 
        return ['data' => $rol, 'status' => 200];
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
        $rol = RolModel::findOrFail($id); 
        $rol->update([
            'nombre' => $request->get('nombre')        
        ]);
        return ['data' => $rol, 'status' => 200];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = RolModel::findOrFail($id); 
        $rol->update([
            'estado' => 0 
        ]);
        return ['data' => $rol, 'status' => 200];
    }

    public function restore(string $id)
    {
        $rol = RolModel::findOrFail($id); 
        $rol->update([
            'estado' => 1 
        ]);
        return ['data' => $rol, 'status' => 200];
    }

    public function disabled()
    {
        $roles = RolModel::where('estado', 0)->get();
        return ['data' => $roles, 'status' => 200];
    }
}
