<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class CorreoController extends Controller
{

    public function getEnviar()
    {
        return view("ecografias.correo.enviar");
    }

    public function getEnviarTodos()
    {
        return view("ecografias.correo.enviar_todos");
    }

    public function getEnviarTodosResultados()
    {
        return view("ecografias.correo.enviar_todos_resultados");
    }

    public function getRecibidos()
    {
        return view("ecografias.correo.recibidos");
    }
}
