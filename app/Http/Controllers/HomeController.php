<?php

namespace App\Http\Controllers;

use App\Models\Appartement;

class HomeController extends Controller
{
    public function index()
    {

        $appartements = Appartement::query()->latest()->take(3)->get();
        return view('home.home', ['appartements' => $appartements]);
    }
}
