<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function index()
    {
        $annee = now()->year;
        $userId = auth()->id();

        $classements = \App\Models\KpiClassement::with('kpi')
                        ->where('user_id', $userId)
                        ->where('annee', $annee)
                        ->orderByDesc('poids')
                        ->get();
        
        $moyennes = \App\Models\KpiClassement::select('kpi_id')
            ->selectRaw('AVG(rang) as moyenne_rang')
            ->where('annee', $annee)
            ->groupBy('kpi_id')
            ->with('kpi')
            ->get();

        // Calculer les poids moyens
        $totalScore = $moyennes->sum(function ($item) {
            return 7 - $item->moyenne_rang;
        });

        // Ajouter le poids à chaque KPI
        $moyennes = $moyennes->map(function ($item) use ($totalScore) {
            $score = 7 - $item->moyenne_rang;
            $item->poids_moyen = round(($score / $totalScore) * 100, 2);
            return $item;
        });

        // Trier les KPI selon poids (et non moyenne pour éviter ex æquo)
        $moyennes = $moyennes->sortByDesc('poids_moyen')->values();

        return view('home', compact('classements', 'moyennes'));
    }


    public function welcome()
    {
        // $user = User::find(2);
        // $user->assignRole('Admin');
        $etablissements = Etablissement::all();
        return view('welcome', compact('etablissements'));
    }
}
