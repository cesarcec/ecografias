<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Resultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteWebController extends Controller
{
    public function getIndex() {
        return view('ecografias.cliente_web.index');
    }

    public function getResultado() {
        return view('ecografias.cliente_web.resultado');
    }

    public function getShow(string $id) {
        $resultado = Resultado::findOrFail($id);
        $resultado->load (
            'examen.ordenExamen.paciente.user', 
            'examen.ordenExamen.doctor.user', 
            'examen.ordenExamen.estudio'
        );
        return view('ecografias.cliente_web.confirmar')->with('resultado', $resultado);
    }

    public function getEnvio() {
        return view('ecografias.cliente_web.envio');
    }
}
