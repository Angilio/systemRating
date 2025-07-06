<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EtablissementController extends Controller
{
    public function index()
    {
        $etablissements = Etablissement::all();
        return view('etablissements.index', compact('etablissements'));
    }

    public function create()
    {
        return view('etablissements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Libelee' => 'required|string|max:25',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public'); // stocke dans storage/app/public/logos
            $validated['logo'] = $path; // enregistre le chemin dans la colonne 'logo'
        }

        Etablissement::create($validated);

        return redirect()->route('etablissements.index')->with('success', 'Établissement ajouté.');
    }

    public function edit(Etablissement $etablissement)
    {
        return view('etablissements.create', compact('etablissement'));
    }

    public function update(Request $request, Etablissement $etablissement)
    {
        $validated = $request->validate([
            'Libelee' => 'required|string|max:25',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048'
        ]);

        // Si un nouveau fichier est uploadé
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien fichier s'il existe
            if ($etablissement->logo && Storage::disk('public')->exists($etablissement->logo)) {
                Storage::disk('public')->delete($etablissement->logo);
            }

            // Enregistrer le nouveau fichier
            $path = $request->file('logo')->store('logos', 'public'); // => storage/app/public/logos
            $validated['logo'] = $path; // Chemin enregistré dans la BDD
        }

        $etablissement->update($validated);

        return redirect()->route('etablissements.index')->with('success', 'Établissement modifié.');
    }

    public function destroy(Etablissement $etablissement)
    {
        $etablissement->delete();

        return redirect()->route('etablissements.index')->with('success', 'Établissement supprimé.');
    }
}
