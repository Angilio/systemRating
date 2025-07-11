<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\KpiClassement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KpiClassementController extends Controller
{

    public function create()
    {
        $kpis = Kpi::all();
        return view('kpis.classement', compact('kpis'));
    }

    public function store(Request $request)
    {
        $annee = now()->year;
        $userId = Auth::id();

        // Vérifie si ce user a déjà fait un classement pour cette année
        $existe = KpiClassement::where('user_id', $userId)
                                ->where('annee', $annee)
                                ->exists();

        if ($existe) {
            return back()->withErrors(['rang' => 'Vous avez déjà effectué le classement des KPI pour cette année.']);
        }

        $rangs = $request->input('rang');

        if (count($rangs) !== 6 || count(array_unique($rangs)) !== 6 || min($rangs) < 1 || max($rangs) > 6) {
            return back()->withErrors(['rang' => 'Chaque KPI doit avoir un rang unique entre 1 et 6.']);
        }

        $scores = collect($rangs)->map(fn($rang) => 7 - $rang);
        $sommeScores = $scores->sum();

        foreach ($rangs as $kpi_id => $rang) {
            $score = 7 - $rang;
            $poids = round(($score / $sommeScores) * 100, 2);

            KpiClassement::create([
                'user_id' => $userId,
                'kpi_id' => $kpi_id,
                'rang' => $rang,
                'poids' => $poids,
                'annee' => $annee,
            ]);
        }

        return redirect()->route('evaluation.questions')->with('success', 'Classement enregistré. Passez aux questions.');
    }

}
