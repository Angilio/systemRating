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
        $rangs = $request->input('rang');

        if (count($rangs) !== 6 || count(array_unique($rangs)) !== 6 || min($rangs) < 1 || max($rangs) > 6) {
            return back()->withErrors(['rang' => 'Chaque KPI doit avoir un rang unique entre 1 et 6.']);
        }

        $scores = collect($rangs)->map(fn($rang) => 7 - $rang);
        $sommeScores = $scores->sum();

        foreach ($rangs as $kpi_id => $rang) {
            $score = 7 - $rang;
            $poids = round(($score / $sommeScores) * 100, 2);

            KpiClassement::updateOrCreate([
                'user_id' => Auth::id(),
                'kpi_id' => $kpi_id,
            ], [
                'rang' => $rang,
                'poids' => $poids,
            ]);
        }

        return redirect()->route('evaluation.questions')->with('success', 'Classement enregistré. Passez aux questions.');
    }

}
