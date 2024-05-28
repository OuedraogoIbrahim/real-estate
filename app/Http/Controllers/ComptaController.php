<?php

namespace App\Http\Controllers;

use App\Models\Flash;
use Illuminate\Http\Request;

class ComptaController extends Controller
{
    public function index(Request $request)
    {
        return view('compta');
    }

    public function treat(Request $request)
    {

        if (isset($request->compteur)) {
            $compteur = $request->compteur;
            for ($i = 1; $i <= $compteur; $i++) {
                $flash = new Flash();
                $flash->date_time = $request->get("date" . $i);
                $flash->libelle = $request->get("libelle" . $i);
                $flash->debit = $request->get("debit" . $i);
                $flash->credit = $request->get("credit" . $i);
                $flash->numero = $request->account;
                $flash->save();
            }
        } else {
            for ($i = 1; $i <= 4; $i++) {
                $flash = new Flash();
                $flash->date = $request->get("date" . $i);
                $flash->libelle = $request->get("libelle" . $i);
                $flash->debit = $request->get("debit" . $i);
                $flash->credit = $request->get("credit" . $i);
                $flash->save();
            }
        }
    }

    public function afficher(Request $request)
    {
        if ($request->account) {
            $flashes = Flash::query()->where('numero', $request->account)->get();
            return view('afficher', ['flashes' => $flashes]);
        }
        return view('afficher');
    }
}
