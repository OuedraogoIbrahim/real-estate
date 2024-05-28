<?php

namespace App\Http\Controllers;

use App\Models\Appartement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class NavController extends Controller
{
    public function presentation()
    {
        return view('navbar.presentation');
    }


    public function estimer()
    {
        return view('navbar.estimation');
    }

    public function contact_form(Request $request)
    {
        $appartement = Appartement::query()->findOrFail($request->id);
        $title = $appartement->titre;
        return view('navbar.contact', ['titre' => $title]);
    }

    public function contact(Request $request)
    {
        $valid = $request->validate(
            [
                'nom' => ['required', 'between:3,12'],
                'email' => ['required', 'email'],
                'motif' => ['required', 'between:4,20'],
                'titre' => ['required', 'exists:appartements,titre']
            ]
        );

        Storage::disk('public')->put('contact/' . date('d-M-y') . '.txt', now() . ' : ' . $valid['nom'] . ' : ' . $valid['email'] . ' : ' . $valid['motif']);
        return redirect()->back()->with('statut', 'Message envoye avec succes');
    }
}
