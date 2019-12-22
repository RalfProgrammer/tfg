<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class LoginController extends Controller
{
    public function login(Request $request) {
        $validatedData = $request->validate([
            'dni' => 'required|min:9|max:9|exists:users,dni',
            'password' => 'required|min:6',
        ]);
        $dni = $request->input('dni');
        $pass = $request->input('password');
        $passEnc = Hash::make($pass);
        $user = User::where('dni', $dni)->where('password', $passEnc)->get();
        if($user->isEmpty()) {
            return back()->withErrors("Authentication failed");
        }
        // TODO: Generar variables de session llamada 'user_hv' con el objeto $user
        return redirect('user/dashboard');
    }
}
