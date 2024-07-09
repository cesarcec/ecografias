<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteWebController extends Controller
{
    public function getIndex() {
        return view('ecografias.cliente_web.index');
    }

    public function getResultado(string $id) {
        return view('ecografias.cliente_web.resultado');
    }
}