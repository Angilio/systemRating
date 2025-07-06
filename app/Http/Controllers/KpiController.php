<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kpi;

class KpiController extends Controller
{
    public function index()
    {
        $kpis = Kpi::all();
        return view('kpis.index', compact('kpis'));
    }

    public function create()
    {
        return view('kpis.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:255']);

        Kpi::create(['nom' => $request->nom]);

        return redirect()->route('kpis.index')->with('success', 'KPI ajouté avec succès.');
    }

    public function edit(Kpi $kpi)
    {
        return view('kpis.edit', compact('kpi'));
    }

    public function update(Request $request, Kpi $kpi)
    {
        $request->validate(['nom' => 'required|string|max:255']);

        $kpi->update(['nom' => $request->nom]);

        return redirect()->route('kpis.index')->with('success', 'KPI modifié avec succès.');
    }
}
