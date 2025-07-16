<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EtudiantController extends Controller
{
    public function espace()
    {
        $user = Auth::user()->load('mention', 'etablissement');
        return view('users.espace', compact('user'));
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
         /** @var \App\Models\User $user */
        $user = Auth::user();

        // Supprimer l'ancienne photo si elle existe
        if ($user->profil && Storage::disk('public')->exists($user->profil)) {
            Storage::disk('public')->delete($user->profil);
        }

        // Stocker la nouvelle photo
        $path = $request->file('profil')->store('images/profils', 'public');
        $user->profil = $path;
        $user->save();

        return redirect()->back()->with('success', 'Photo de profil mise à jour avec succès.');
    }
}

