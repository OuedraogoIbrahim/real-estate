<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function loginform()
    {
        return view('login.loginform');
    }
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:16'],
        ]);

        $user = User::query()->where('email', $request->email)->get();
        foreach ($user as $us) {
            if ($us->confirmation_token !== null) {
                return redirect('/')->with('statut', 'Confirmation obligatoire de votre email pour éffectuer cette action');
            }
        }


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('statut', 'Vous avez été authentifié avec succès');
        }

        return back()->withErrors([
            'email' => 'Informations Eronées',
        ])->onlyInput('email');
    }
}
