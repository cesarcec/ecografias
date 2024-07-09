<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getIndex() {
        $userAuth = Auth::user();
        if (!$userAuth) {
            return redirect('/cliente-web');
        }
        // return $userAuth;
        if ( $userAuth->rol->nombre == 'Paciente') {
            return view('ecografias.cliente_web.index');
        }
        return view('ecografias.dashboard.index')->with('user', $userAuth);
    }

    public function userRol() {
        $result = User::all();
        $result->load('rol'); //select user.* from user, rol where user.rol_id = rol.id 
        return $result;
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
