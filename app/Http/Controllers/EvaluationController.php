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
        // $question2 = Question::create([
        //     'intitule' => 'Dans l\'ensemble, êtes-vous satisfait(e) de votre expérience dans votre mention et votre établissement?',
        //     'type' => 'choix',
        //     'kpi_id' => 2, // <--- Ajout du lien au KPI
        // ]);

        // $question2->options()->createMany([
        //     ['texte' => 'Non', 'score' => 0],
        //     ['texte' => 'Plus ou moins', 'score' => 1],
        //     ['texte' => 'Oui', 'score' => 2],
        // ]);

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
                $score = 0;
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

        // ➤ Recalcul automatique après soumission
        $this->mettreAJourNoteEtClassement($user);

        return redirect()->route('dashboard')->with('success', 'Évaluation soumise avec succès.');
    }


    public function calculerNoteEtudiant(User $etudiant): float
    {
        $annee = now()->year;

        $evaluations = Evaluation::with('question.kpi')
            ->where('user_id', $etudiant->id)
            ->where('annee', $annee)
            ->get();

        // Groupe par KPI
        $groupes = $evaluations->groupBy(fn($eval) => $eval->question->kpi_id);
        $noteTotale = 0;

        foreach ($groupes as $kpiId => $group) {
            $scoreBrut = $group->sum('score');

            // Poids moyen dynamique du KPI
            $poids = KpiClassement::where('kpi_id', $kpiId)
                        ->whereNotNull('user_id')
                        ->where('annee', $annee)
                        ->avg('poids');

            if ($poids !== null) {
                $noteTotale += ($scoreBrut * ($poids / 100));
            }
        }

        // ✅ Calcul du score total maximum possible
        $noteMax = \App\Models\Question::with('options')
            ->get()
            ->sum(fn($q) => $q->options->max('score'));

        return $noteMax > 0 ? round(($noteTotale / $noteMax) * 100, 2) : 0;
    }

    public function calculerNoteMention(Mention $mention): array
    {
        $etudiants = $mention->users;
        $notes = [];

        foreach ($etudiants as $etudiant) {
            if ($etudiant->evaluations()->exists()) {
                $notes[] = $this->calculerNoteEtudiant($etudiant);
            }
        }

        $note = count($notes) > 0 ? round(array_sum($notes) / count($notes), 2) : null;

        return [
            'note' => $note,
            'nbEvaluateurs' => count($notes),
            'nbTotal' => $etudiants->count(),
        ];
    }



    public function calculerNoteEtablissement($etablissement): ?float
    {
        $mentions = $etablissement->mentions;
        $notes = [];

        foreach ($mentions as $mention) {
            $noteMention = $this->calculerNoteMention($mention);
            if ($noteMention['note'] !== null) {
                $notes[] = $noteMention['note'];
            }
        }

        return count($notes) > 0 ? round(array_sum($notes) / count($notes), 2) : null;
    }


    private function mettreAJourNoteEtClassement(User $etudiant)
    {
        // ➤ Note étudiant
        $note = $this->calculerNoteEtudiant($etudiant);
        $etudiant->update(['note' => $note]);

        // ➤ Note de la mention
        $mention = $etudiant->mention;
        if ($mention) {
            $noteMentionData = $this->calculerNoteMention($mention);
            $mention->update([
                'note' => $noteMentionData['note'],
            ]);

            // ➤ Note de l’établissement
            $etablissement = $mention->etablissement;
            if ($etablissement) {
                $noteEtab = $this->calculerNoteEtablissement($etablissement);
                $etablissement->update(['note' => $noteEtab]);
            }
        }

        // ➤ Classement dynamique : Mentions
        \App\Models\Mention::orderByDesc('note')->get()->each(function ($m, $index) {
            $m->update(['rang' => $index + 1]);
        });

        // ➤ Classement dynamique : Établissements
        \App\Models\Etablissement::orderByDesc('note')->get()->each(function ($e, $index) {
            $e->update(['rang' => $index + 1]);
        });
    }


}
