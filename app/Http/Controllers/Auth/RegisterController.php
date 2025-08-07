<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Etablissement;  // <-- ajoute cette ligne pour utiliser le modèle Etablissement
use App\Notifications\CustomVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        // Seul un admin peut accéder
        $this->middleware(['auth', 'is_admin']);
    }

    public function showRegistrationForm()
    {
        // Récupérer tous les établissements pour la vue
        $etablissements = Etablissement::all();

        return view('auth.register', compact('etablissements'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'etablissement_id' => 'required|exists:etablissements,id',
            'mention_id' => 'required|exists:mentions,id',
            'niveau' => 'required|string|max:50',
        ]);

        // Générer un mot de passe aléatoire à 8 chiffres
        $plainPassword = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);

        // Créer l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
            'etablissement_id' => $request->etablissement_id,
            'mention_id' => $request->mention_id,
            'niveau' => $request->niveau,
        ]);
        // Assigner le role Etudiant
        $user->assignRole('Admin');

        // Attacher le mot de passe temporairement pour l’email
        $user->plain_password = $plainPassword;

        // Envoyer un email personnalisé de vérification
        $user->notify(new CustomVerifyEmail());

        // Retour vers une page admin avec message
        return redirect()->back()->with('success', 'Étudiant enregistré. Email de vérification envoyé.');
    }
}
