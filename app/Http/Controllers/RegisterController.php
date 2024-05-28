<?php

namespace App\Http\Controllers;

use App\Events\RegisterConfirmationEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function registerform()
    {
        return view('register.registerform');
    }

    public function register(Request $request)
    {
        $valid = $request->validate(
            [
                'pseudo' => ['required', 'min:3', 'max:28'],
                'email' => ['required', 'email', 'unique:users,email'],
                'mdp' => ['required', 'string', 'min:8', 'max:16', 'confirmed']
            ]
        );


        $user = new User();
        $user->pseudo = $valid['pseudo'];
        $user->email = $valid['email'];

        $valid['mdp'] = Hash::make($valid['mdp']);
        $user->password = $valid['mdp'];
        $user->confirmation_token = Str::random(20);
        $user->save();
        event(new RegisterConfirmationEvent($user->id));
        // Auth::login($user);
        return redirect('/')->with('statut', 'Compte créé avec succès. Pour que l\'inscription soit complète veuillez cliquez sur le lien qui vous a été envoyer par mail');
    }

    public function register_confirmation($id, $token, Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $user = User::query()->where(['id' => $id, 'confirmation_token' => $token]);
        $user->update(['confirmation_token' => null]);
        Auth::login($user);
        return redirect('/')->with('statut', 'Compte confirmé avec succès');
    }
}
