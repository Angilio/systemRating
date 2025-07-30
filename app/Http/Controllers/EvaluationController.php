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

        // ➤ Recalcul global après soumission
        $this->mettreAJourTout();

        return redirect()->route('dashboard')->with('success', 'Évaluation soumise avec succès.');
    }

    public function mettreAJourTout()
    {
        $annee = now()->year;

        // ➤ Recalcul de toutes les notes étudiantes
        $etudiants = User::whereHas('evaluations', function ($q) use ($annee) {
            $q->where('annee', $annee);
        })->get();

        foreach ($etudiants as $etudiant) {
            $note = $this->calculerNoteEtudiant($etudiant);
            $etudiant->update(['note' => $note]);
        }

        // ➤ Recalcul de toutes les mentions
        foreach (Mention::all() as $mention) {
            $data = $this->calculerNoteMention($mention);
            $mention->update(['note' => $data['note']]);
        }

        // ➤ Recalcul de tous les établissements
        foreach (\App\Models\Etablissement::all() as $etab) {
            $note = $this->calculerNoteEtablissement($etab);
            $etab->update(['note' => $note]);
        }

        // ➤ Classement dynamique : Mentions
        Mention::orderByDesc('note')->get()->each(function ($m, $index) {
            $m->update(['rang' => $index + 1]);
        });

        // ➤ Classement dynamique : Établissements
        \App\Models\Etablissement::orderByDesc('note')->get()->each(function ($e, $index) {
            $e->update(['rang' => $index + 1]);
        });
    }

    public function calculerNoteEtudiant(User $etudiant): float
    {
        $annee = now()->year;

        $evaluations = Evaluation::with('question.kpi')
            ->where('user_id', $etudiant->id)
            ->where('annee', $annee)
            ->get();

        $groupes = $evaluations->groupBy(fn($eval) => $eval->question->kpi_id);
        $noteFinale = 0;

        foreach ($groupes as $kpiId => $group) {
            $scoreObtenu = $group->sum('score');
            $scoreMax = $group->sum(fn($eval) => $eval->question->options->max('score'));

            if ($scoreMax == 0) continue;

            $poids = KpiClassement::where('kpi_id', $kpiId)
                        ->where('annee', $annee)
                        ->avg('poids');

            if ($poids === null) continue;

            $noteKpi = ($scoreObtenu / $scoreMax) * ($poids / 100);
            $noteFinale += $noteKpi;
        }

        return round($noteFinale * 100, 2);
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
}