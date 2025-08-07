<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\EvaluationController;
use App\Models\Evaluation;
use App\Models\Kpi;
use App\Models\TauxReussite;

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


        $etablissement = $mention?->etablissement;
        $noteEtablissement = $etablissement?->note ?? null;
        $nbEtudiantsEtablissement = $etablissement?->users()->count() ?? 0;
        $nbEvaluateursEtablissement = $etablissement
            ? $etablissement->users()->whereHas('evaluations', fn($q) => $q->where('annee', $annee))->count()
            : 0;

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
            'nbEtudiantsMention',
            'nbEvaluateursMention',
            'noteEtablissement',
            'nbEtudiantsEtablissement',
            'nbEvaluateursEtablissement',
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
        $etablissements = Etablissement::with(['mentions', 'users'])->get();

        // Couleurs pour les graphiques
        $colors = ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#ff6b6b', '#6c757d'];

        // 🔹 Nouveau : Total des utilisateurs (sans filtre profil)
        $totalEtudiants = \App\Models\User::count();

        // 🔹 Nouveau : Comptage par établissement (sans filtre profil)
        $etudiantsParEtablissement = $etablissements->mapWithKeys(function ($etab) {
            return [$etab->Libelee => $etab->users->count()];
        });

        // 🔹 Classement des établissements
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

        // 🔹 Classement des mentions par établissement
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

        // // 🔹 Récupération des 9 établissements
        $etablissementsListe = Etablissement::take(9)->get();

        // // 🔹 Récupération des 6 KPI
        $kpis = Kpi::all();

       
        $scoreMaxParKpi = [
            1 => 9,
            2 => 2,
            4 => 5,
            5 => 4,
            6 => 5,
        ];

        $tableauCroise = [];

        foreach ($kpis as $kpi) {
            $ligne = ['kpi' => $kpi->nom];
            $scoreMax = $scoreMaxParKpi[$kpi->id] ?? null;

            if (!$scoreMax) {
                // Sauter le KPI si pas de score max (ex: Taux de réussite)
                foreach ($etablissementsListe as $etab) {
                    $ligne[$etab->Libelee] = null;
                }
                $tableauCroise[] = $ligne;
                continue;
            }

            // Récupérer les question_id de ce KPI
            $questionIds = Question::where('kpi_id', $kpi->id)->pluck('id');

            foreach ($etablissementsListe as $etab) {
                // Récupérer les étudiants de cet établissement
                $etudiants = $etab->users;

                $notesEtudiants = [];

                foreach ($etudiants as $etudiant) {
                    // Scores de cet étudiant sur les questions de ce KPI
                    $scores = Evaluation::where('user_id', $etudiant->id)
                        ->whereIn('question_id', $questionIds)
                        ->pluck('score');

                    if ($scores->count()) {
                        $total = $scores->sum();
                        $noteEtudiant = ($total / $scoreMax) * 100;
                        $notesEtudiants[] = $noteEtudiant;
                    }
                }

                // Moyenne sur les étudiants ayant évalué
                $moyenneKpi = count($notesEtudiants)
                    ? round(array_sum($notesEtudiants) / count($notesEtudiants), 2)
                    : null;

                $ligne[$etab->Libelee] = $moyenneKpi;
            }

            $tableauCroise[] = $ligne;
        }

        // 🔹 Étape 1 : Charger tous les taux avec mention + établissement
        $tauxReussites = TauxReussite::with('mention.etablissement')->get();

        // 🔹 Étape 2 : Grouper les taux par établissement
        $tauxParEtablissement = [];

        foreach ($tauxReussites as $taux) {
            $etab = $taux->mention->etablissement;
            if (!$etab) continue;

            $libelle = $etab->Libelee;

            if (!isset($tauxParEtablissement[$libelle])) {
                $tauxParEtablissement[$libelle] = [
                    'sum' => 0,
                    'count' => 0
                ];
            }

            $tauxParEtablissement[$libelle]['sum'] += $taux->taux;
            $tauxParEtablissement[$libelle]['count']++;
        }

        // 🔹 Étape 3 : Remplir la 3e ligne du tableau (index 2)
        if (isset($tableauCroise[2]) && $tableauCroise[2]['kpi'] === 'Taux de réussite') {
            foreach ($etablissementsListe as $etab) {
                $libelle = $etab->Libelee;

                if (isset($tauxParEtablissement[$libelle])) {
                    $sum = $tauxParEtablissement[$libelle]['sum'];
                    $count = $tauxParEtablissement[$libelle]['count'];

                    $tableauCroise[2][$libelle] = $count > 0
                        ? round($sum / $count, 2)
                        : null;
                } else {
                    $tableauCroise[2][$libelle] = null;
                }
            }
        }

        return view('classement', compact(
            'totalEtudiants',
            'etudiantsParEtablissement',
            'classementEtablissements',
            'classementParEtablissement',
            'colors',
            'tableauCroise',
        ));
    }

}
