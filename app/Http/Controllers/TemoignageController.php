<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::latest()->with('user')->get();
        return view('temoignages.index', compact('temoignages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
        ]);

        Temoignage::create([
            'user_id' => auth()->id(),
            'titre' => $request->titre,
            'contenu' => $request->contenu,
        ]);

        return back()->with('success', 'Merci pour votre témoignage !');
    }
}