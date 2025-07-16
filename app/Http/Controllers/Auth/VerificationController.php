<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request; // ← À ajouter

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // ✅ Redirection personnalisée après vérification
    protected function verified(Request $request)
    {
        return redirect('/login')->with('success', 'Email vérifié avec succès. Vous pouvez maintenant vous connecter.');
    }
}
