<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use \stdClass;



class AuthController extends Controller
{
    // Funciones para el registro, login y logout de usuarios
    public function register(Request $request){
        // Para registrarte
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return back();
        //return redirect()->route('catalogo')->with('success', 'Registro exitoso. Bienvenido, '.$user->name);
    }

    public function login(Request $request){
        // Para logearte si ya estas registrado
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        Auth::login($user);

        return back();
        //return redirect()->route('catalogo')->with('success', 'Bienvenido, '.$user->name);
    }

    public function logout(Request $request){
        // Cierra la sesión del usuario autenticado
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return back();
        //return redirect()->route('catalogo')->with('success', 'Logout correcto');
    }
}
