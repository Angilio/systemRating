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
    public function index()
    {
        // $question1 = Question::create([
        //     'intitule' => 'Les supports pédagogiques sont-ils accessibles ?',
        //     'type' => 'choix',
        //     'kpi_id' => 1, // <--- Ajout du lien au KPI
        // ]);

        // $question1->options()->createMany([
        //     ['texte' => 'Non', 'score' => 0],
        //     ['texte' => 'Plus ou moins', 'score' => 1],
        //     ['texte' => 'Oui', 'score' => 2],
        // ]);


        $questions = Question::with('options')->get();
        return view('evaluation.index', compact('questions'));
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
}
