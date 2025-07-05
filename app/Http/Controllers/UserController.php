<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLogin() {
        return view("auth.login");
    }

    public function login(Request $request) {
        $credentials = $request->only("email", "password");
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route("index");
        }
        return redirect()->route("user.showLogin")->with("error", "Credenciais inválidas");
        
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route("user.showLogin")->with("success","Usuário desconectado");
    }
}
