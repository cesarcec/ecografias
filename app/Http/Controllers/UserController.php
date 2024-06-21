<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getIndex() {
        return view('ecografias.dashboard.index');
    }

    public function userRol() {
        $result = User::all();
        $result->load('rol'); //select user.* from user, rol where user.rol_id = rol.id 
        return $result;
    }

    
}
