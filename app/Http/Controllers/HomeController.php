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

    public function index()
    {
        $annee = now()->year;
        $user = auth()->user();
        $userId = $user->id;

        // 1. Classement personnel des KPI (rang individuel)
        $classements = \App\Models\KpiClassement::with('kpi')
                        ->where('user_id', $userId)
                        ->where('annee', $annee)
                        ->orderByDesc('poids')
                        ->get();

        // 2. Classement global des KPI (moyenne des rangs)
        $moyennes = \App\Models\KpiClassement::select('kpi_id')
            ->selectRaw('AVG(rang) as moyenne_rang')
            ->where('annee', $annee)
            ->groupBy('kpi_id')
            ->with('kpi')
            ->get();

        $totalScore = $moyennes->sum(function ($item) {
            return 7 - $item->moyenne_rang;
        });

        $moyennes = $moyennes->map(function ($item) use ($totalScore) {
            $score = 7 - $item->moyenne_rang;
            $item->poids_moyen = round(($score / $totalScore) * 100, 2);
            return $item;
        })->sortByDesc('poids_moyen')->values();

        // 3. Note individuelle de l'étudiant
        $evaluationController = new \App\Http\Controllers\EvaluationController;
        $noteEtudiant = $evaluationController->calculerNoteEtudiant($user);

        // 4. Note de la mention
        $mention = $user->mention;
        $noteMention = $evaluationController->calculerNoteMention($mention);

        // 5. Classement des mentions de l’établissement
        $etablissement = $mention->etablissement;
        $classementMentions = $etablissement->mentions->map(function ($m) use ($evaluationController) {
            return [
                'mention' => $m->name,
                'note' => $evaluationController->calculerNoteMention($m),
            ];
        })->sortByDesc('note');

        // 6. Classement des établissements
        $etablissements = \App\Models\Etablissement::all();
        $classementEtablissements = $etablissements->map(function ($e) use ($evaluationController) {
            return [
                'etablissement' => $e->name,
                'note' => $evaluationController->calculerNoteEtablissement($e),
            ];
        })->sortByDesc('note');

        return view('home', compact(
            'classements',
            'moyennes',
            'noteEtudiant',
            'noteMention',
            'classementMentions',
            'classementEtablissements'
        ));
    }



    public function welcome()
    {
        // $user = User::find(2);
        // $user->assignRole('Admin');
        $etablissements = Etablissement::all();
        return view('welcome', compact('etablissements'));
    }
}
