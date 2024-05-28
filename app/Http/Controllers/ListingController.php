<?php

namespace App\Http\Controllers;

use App\Models\Appartement;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ListingController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all();
        $appartements = Appartement::query();


        if ($category_id = $request->category) {

            // $appartements = Category::query()->find($select)->appartements(); Cette solution utilise les relations
            $appartements = $appartements->where('category_id', $category_id); // 2eme solution plus optimiser pour pouvoir utiliser les methodes de scope
        }

        if ($prix = $request->prix) {
            $appartements = $appartements->where('prix', '<=', $prix);
        }

        if ($surface = $request->surface) {
            $appartements = $appartements->where('surface', '>=', $surface);
        }

        if ($chambres = $request->chambres) {
            $appartements = $appartements->where('chambres', '<=', $chambres);
        }
        if ($search = $request->search) {
            $appartements = $appartements->where('titre', 'like', '%' . $search . '%')->orWhere('description', 'LIKE', "%{$request->input('search')}%");
        }

        $verify_appartement = $appartements->get();
        if ($verify_appartement->isEmpty()) {
            abort('403', 'Aucun bien trouvé');
        }

        return view('listing.index', ['appartements' => $appartements->paginate(3)->withQueryString(), 'categories' => $categories, 'request' => $request]);
    }
    public function show(string $titre, int $appartement): View
    {

        $titre = Str::replace('-', ' ', $titre);
        $appartement = Appartement::query()->where(['titre' => $titre, 'id' => $appartement])->get();
        if ($appartement->isEmpty()) {
            abort(404);
        }
        foreach ($appartement as $appart) {
            return view('listing.un_immeuble', ['appartement' => $appart]);
        }
    }
}
