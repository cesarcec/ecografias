<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getIndex() {
        $userAuth = Auth::user();
        $userAuth->load('doctor', 'paciente', 'recepcionista', 'rol');
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
