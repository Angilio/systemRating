<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\EvaluationController;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome','classement']);
    }

    public function index()
    {
        $annee = now()->year;
        $user = auth()->user();

        // 1. Classement personnel des KPI
        $classements = \App\Models\KpiClassement::with('kpi')
            ->where('user_id', $user->id)
            ->where('annee', $annee)
            ->orderByDesc('poids')
            ->get();

        // 2. Classement global des KPI
        $moyennes = \App\Models\KpiClassement::select('kpi_id')
            ->selectRaw('AVG(rang) as moyenne_rang')
            ->where('annee', $annee)
            ->groupBy('kpi_id')
            ->with('kpi')
            ->get();

        $totalScore = $moyennes->sum(fn($item) => 7 - $item->moyenne_rang);

        $moyennes = $moyennes->map(function ($item) use ($totalScore) {
            $score = 7 - $item->moyenne_rang;
            $item->poids_moyen = round(($score / $totalScore) * 100, 2);
            return $item;
        })->sortByDesc('poids_moyen')->values();

        // 3. Note de l’étudiant
        $noteEtudiant = $user->note ?? 0;

        // 4. Infos sur la mention
        $mention = $user->mention;
        $noteMention = $mention?->note;
        $nbEtudiantsMention = $mention?->users()->count() ?? 0;
        $nbEvaluateursMention = $mention
            ? $mention->users()->whereHas('evaluations', fn($q) => $q->where('annee', $annee))->count()
            : 0;

        // 5. Infos établissement
        $etablissement = $mention?->etablissement;
        $noteEtablissement = $etablissement?->note;

        $classementMentions = $etablissement?->mentions()
            ->orderByDesc('note')
            ->get()
            ->map(fn($m) => [
                'mention' => $m->Libelee,
                'note' => $m->note,
            ]);

        $classementEtablissements = Etablissement::orderByDesc('note')->get()
            ->map(fn($e) => [
                'etablissement' => $e->Libelee,
                'note' => $e->note,
            ]);

        return view('home', compact(
            'classements',
            'moyennes',
            'noteEtudiant',
            'noteMention',
            'noteEtablissement',
            'nbEvaluateursMention',
            'nbEtudiantsMention',
            'classementMentions',
            'classementEtablissements'
        ));
    }

    public function welcome()
    {
        $etablissements = Etablissement::all();
        return view('welcome', compact('etablissements'));
    }

    public function classement()
    {
        $etablissements = Etablissement::with('mentions')->get();

        // Couleurs pour les graphiques
        $colors = ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#ff6b6b', '#6c757d'];

        // Classement des établissements (y compris ceux sans note)
        $classementEtablissements = $etablissements->sortByDesc(fn($e) => $e->note ?? 0)
            ->values()
            ->map(function ($e, $index) {
                return [
                    'id' => $e->id,
                    'rang' => $index + 1,
                    'etablissement' => $e->Libelee,
                    'note' => $e->note,
                ];
            });

        // Classement des mentions par établissement
        $classementParEtablissement = [];

        foreach ($etablissements as $etab) {
            $mentions = $etab->mentions()->orderByDesc('note')->get();

            $mentionsTableau = [];
            $labels = [];
            $scores = [];
            $afficherGraph = false;

            foreach ($mentions as $index => $mention) {
                $labels[] = $mention->Libelee;
                $hasNote = $mention->note !== null;
                $score = $hasNote ? $mention->note : 1;
                $scores[] = $score;

                if ($hasNote) {
                    $afficherGraph = true;
                }

                $mentionsTableau[] = [
                    'rang' => $index + 1,
                    'nom' => $mention->Libelee,
                    'note' => $hasNote ? $mention->note : null,
                ];
            }

            $classementParEtablissement[$etab->Libelee] = [
                'graph' => $afficherGraph,
                'labels' => $labels,
                'scores' => $scores,
                'tableau' => collect($mentionsTableau),
            ];
        }

        return view('classement', compact('classementEtablissements', 'classementParEtablissement', 'colors'));
    }


}
