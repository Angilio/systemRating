<?php

namespace App\Http\Controllers;

use App\Models\Mention;
use App\Models\TauxReussite;
use App\Models\KpiClassement;
use App\Models\Etablissement;
use Illuminate\Http\Request;

class TauxReussiteController extends Controller
{
    // public function index()
    // {
    //     $etablissements = Etablissement::with(['mentions.tauxReussites'])->get();

    //     return view('taux.index', compact('etablissements'));
    // }

    public function index()
    {
        // Charger toutes les lignes de taux, avec mention + établissement liés
        $tauxReussites = TauxReussite::with(['mention.etablissement'])->get();

        // Regrouper les taux par établissement
        $etablissements = [];

        foreach ($tauxReussites as $taux) {
            $etab = $taux->mention->etablissement;

            if (!isset($etablissements[$etab->id])) {
                $etablissements[$etab->id] = [
                    'etablissement' => $etab,
                    'mentions' => [],
                    'taux_total' => 0,
                    'taux_count' => 0,
                ];
            }

            $mentionId = $taux->mention->id;

            if (!isset($etablissements[$etab->id]['mentions'][$mentionId])) {
                $etablissements[$etab->id]['mentions'][$mentionId] = [
                    'mention' => $taux->mention,
                    'taux_sum' => 0,
                    'taux_count' => 0,
                ];
            }

            $etablissements[$etab->id]['mentions'][$mentionId]['taux_sum'] += $taux->taux;
            $etablissements[$etab->id]['mentions'][$mentionId]['taux_count']++;

            $etablissements[$etab->id]['taux_total'] += $taux->taux;
            $etablissements[$etab->id]['taux_count']++;
        }

        return view('taux.index', [
            'etablissements' => $etablissements
        ]);
    }

    public function create()
    {
        $etablissements = \App\Models\Etablissement::all();
        return view('taux.create', compact('etablissements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mention_id' => 'required|exists:mentions,id',
            'taux' => 'required|numeric|min:0|max:100',
        ]);

        $annee = now()->year;

        // ⚠️ Vérifie s’il existe déjà un taux pour cette mention cette année
        $existe = TauxReussite::where('mention_id', $request->mention_id)
            ->where('annee', $annee)
            ->exists();

        if ($existe) {
            return redirect()->back()->with(['error' => 'Le taux de réussite pour cette mention a déjà été saisi cette année.']);
        }

        // ➤ Création du taux
        $taux = TauxReussite::create([
            'mention_id' => $request->mention_id,
            'annee' => $annee,
            'taux' => $request->taux
        ]);

        // ➤ Recalcul de la note de la mention
        $mention = $taux->mention;
        $poidsKpi = KpiClassement::where('annee', $annee)
            ->whereHas('kpi', fn($q) => $q->where('nom', 'like', '%taux de réussite%'))
            ->avg('poids');

        $poidsKpi = $poidsKpi ?? 0;
        $noteTaux = ($request->taux / 100) * ($poidsKpi / 100) * 100;

        $notes = $mention->users->map(fn($e) => $e->note)->filter();
        $noteMoyenne = $notes->count() > 0 ? $notes->avg() : 0;

        $mention->note = round($noteTaux + $noteMoyenne, 2);
        $mention->save();

        $this->recalculerNoteEtablissement($mention->etablissement);

        return redirect()->route('taux.index')->with('success', 'Taux de réussite ajouté et note de la mention + établissement mise à jour.');
    }

    private function recalculerNoteEtablissement(Etablissement $etablissement): void
    {
        $notes = [];

        foreach ($etablissement->mentions as $mention) {
            if ($mention->note !== null) {
                $notes[] = $mention->note;
            }
        }

        $etablissement->note = count($notes) > 0
            ? round(array_sum($notes) / count($notes), 2)
            : null;

        $etablissement->save();
    }
}