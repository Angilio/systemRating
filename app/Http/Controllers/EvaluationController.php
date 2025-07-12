<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\KpiClassement;
use App\Models\Mention;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    // public function index()
    // {
    //     // $question1 = Question::create([
    //     //     'intitule' => 'Les supports pédagogiques sont-ils accessibles ?',
    //     //     'type' => 'choix',
    //     //     'kpi_id' => 1, // <--- Ajout du lien au KPI
    //     // ]);

    //     // $question1->options()->createMany([
    //     //     ['texte' => 'Non', 'score' => 0],
    //     //     ['texte' => 'Plus ou moins', 'score' => 1],
    //     //     ['texte' => 'Oui', 'score' => 2],
    //     // ]);


    //     $questions = Question::with('options')->get();
    //     return view('evaluation.index', compact('questions'));
    // }

    public function index()
    {
        $user = auth()->user();
        $annee = now()->year;

        $dejaEvalue = Evaluation::where('user_id', $user->id)
                                ->where('annee', $annee)
                                ->exists();

        if ($dejaEvalue) {
            return view('evaluation.index', ['dejaEvalue' => true]);
        }

        $questions = Question::with('options', 'kpi')->get();
        return view('evaluation.index', compact('questions'));
    }


    public function store(Request $request)
    {
        $user = auth()->user();
        $annee = now()->year;

        // Vérifie s’il a déjà évalué cette année
        $dejaEvalue = Evaluation::where('user_id', $user->id)
                                ->where('annee', $annee)
                                ->exists();

        if ($dejaEvalue) {
            return back()->withErrors(['message' => 'Vous avez déjà effectué votre évaluation pour cette année.']);
        }

        $reponses = $request->input('reponses');

        foreach ($reponses as $question_id => $reponse) {
            $question = \App\Models\Question::with('options')->find($question_id);

            if ($question->type === 'choix') {
                $option = $question->options->where('id', $reponse)->first();
                $score = $option ? $option->score : 0;
                $valeur = $option->texte;
            } else {
                $score = 0; // Pas de score pour texte libre
                $valeur = $reponse;
            }

            Evaluation::create([
                'user_id' => $user->id,
                'question_id' => $question_id,
                'valeur' => $valeur,
                'score' => $score,
                'annee' => $annee,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Évaluation soumise avec succès.');
    }



    public function calculerNoteEtudiant(User $etudiant): float
    {
        $evaluations = Evaluation::with('question.kpi')
            ->where('user_id', $etudiant->id)
            ->get();

        $groupes = $evaluations->groupBy(fn($eval) => $eval->question->kpi_id);
        $noteTotale = 0;

        foreach ($groupes as $kpiId => $group) {
            $scoreBrut = $group->sum('score');

            // Récupérer poids global du KPI
            $poids = KpiClassement::where('kpi_id', $kpiId)
                        ->whereNull('user_id') // Poids global
                        ->value('poids');

            $noteTotale += ($scoreBrut * ($poids / 100));
        }

        return round($noteTotale, 2);
    }

    public function calculerNoteMention(Mention $mention): ?float
    {
        $etudiants = $mention->users;
        $notes = [];

        foreach ($etudiants as $etudiant) {
            $aRepondu = $etudiant->evaluations()->exists();
            if ($aRepondu) {
                $notes[] = $this->calculerNoteEtudiant($etudiant);
            }
        }

        $total = array_sum($notes);
        $nb = count($notes);

        return $nb > 0 ? round($total / $nb, 2) : null;
    }

    public function calculerNoteEtablissement($etablissement): ?float
    {
        $mentions = $etablissement->mentions; // relation : hasMany

        $noteTotale = 0;

        foreach ($mentions as $mention) {
            $noteMention = $this->calculerNoteMention($mention);
            if ($noteMention !== null) {
                $noteTotale += $noteMention;
            }
        }

        return $noteTotale;
    }
}
