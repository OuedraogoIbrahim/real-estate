<?php

namespace App\Http\Controllers;

use App\Models\Appartement;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appartements = Appartement::query()->latest()->paginate(2);
        return view('admin.index', ['appartements' => $appartements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.creationform', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate(
            [
                'titre' => ['required', 'between:4,100', 'string'],
                'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
                'ville' => ['required', 'string'],
                'description' => ['required', 'string', 'between:10,250'],
                'surface' => ['required', 'numeric'],
                'chambres' => ['required', 'numeric'],
                'prix' => ['required', 'numeric'],
                'select' => ['required', 'exists:Categories,id']
            ]
        );


        $imagepath = Storage::disk('public')->put('photos', $valid['image']);
        $appartement = new Appartement();
        $appartement->titre = $valid['titre'];
        $appartement->image = $imagepath;
        $appartement->ville = $valid['ville'];

        $appartement->description = $valid['description'];
        $appartement->surface = $valid['surface'];
        $appartement->chambres = $valid['chambres'];
        $appartement->prix = $valid['prix'];
        $appartement->category_id = $valid['select'];
        $appartement->save();
        return redirect()->route('admin.index')->with('statut', 'Nouveau bien ajouté avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appartement $admin)
    {
        return redirect()->route('show.immeuble', ['titre' => $admin->titre, 'appartement' => $admin->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appartement $admin)
    {
        $categories = Category::all();
        $appartement = $admin;
        $category_appart = $appartement->category;

        return view('admin.editform', ['appartement' => $appartement, 'categories' => $categories, 'category_appart' => $category_appart]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appartement $admin): RedirectResponse
    {
        $appartement = $admin;
        $valid = $request->validate(
            [
                'titre' => ['required', 'between:4,100', 'string'],
                'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
                'ville' => ['required', 'string'],
                'description' => ['required', 'string', 'between:10,250'],
                'surface' => ['required', 'numeric'],
                'chambres' => ['required', 'numeric'],
                'prix' => ['required', 'numeric'],
                'select' => ['required', 'exists:Categories,id']
            ]
        );

        // Suppression de la photo deja existante
        /* La condition pour verifier si une image existe n'est pas necessaire car chaque entree possede une photo
        */
        Storage::disk('public')->delete($appartement->image); //Ancienne image supprimer

        $imagepath = Storage::disk('public')->put('photos', $valid['image']);

        $appartement->titre = $valid['titre'];
        $appartement->image = $imagepath;
        $appartement->ville = $valid['ville'];
        $appartement->description = $valid['description'];
        $appartement->surface = $valid['surface'];
        $appartement->chambres = $valid['chambres'];
        $appartement->prix = $valid['prix'];
        $appartement->update();
        return redirect()->route('admin.index')->with('statut', 'Modifications reussies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appartement $admin): RedirectResponse
    {
        $appartement = $admin;
        $appartement->delete();
        Storage::disk('public')->delete($appartement->image);
        return redirect()->back()->with('statut', 'Suppression reussie');
    }
}
