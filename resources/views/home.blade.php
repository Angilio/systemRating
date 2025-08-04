@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- TITRE PRINCIPAL --}}
    <h1 class="text-primary text-center border border-2 rounded my-3">
        Notes et classements
    </h1>

    {{-- BLOCS DE NOTES --}}
    <div class="row g-3">
        {{-- Note individuelle --}}
        <div class="col-12 col-lg-4">
            <div class="alert {{ $noteEtudiant === 0 ? 'alert-warning' : 'alert-info' }} h-100">
                @if($noteEtudiant === 0)
                    Vous n'avez pas encore effectué votre évaluation. 
                    <a href="{{ route('kpi.classement.create') }}" class="btn btn-sm btn-outline-primary mt-2">Faire l'évaluation</a>
                @else
                    <h4>Votre note d'évaluation : 
                        <span class="badge bg-success fs-5">{{ $noteEtudiant }}/100</span>
                    </h4>
                @endif
            </div>
        </div>

        {{-- Note de la mention --}}
        <div class="col-12 col-lg-4">
            <div class="alert {{ $noteMention !== null ? 'alert-secondary' : 'alert-danger' }} h-100">
                @if($noteMention !== null)
                    <strong>Note de votre mention :</strong>
                    <span class="badge bg-warning text-dark">{{ $noteMention }}/100</span> — 
                    {{ $nbEvaluateursMention }} sur {{ $nbEtudiantsMention }} étudiants ont évalué.
                @else
                    Vous n'êtes pas encore associé à une mention ou aucune évaluation n'a été faite.
                @endif
            </div>
        </div>

        {{-- Note de l’établissement --}}
        <div class="col-12 col-lg-4">
            <div class="alert {{ $noteEtablissement !== null ? 'alert-info' : 'alert-danger' }} h-100">
                @if($noteEtablissement !== null)
                    <strong>Note de votre établissement :</strong>
                    <span class="badge bg-primary">{{ $noteEtablissement }}/100</span> —
                    {{ $nbEvaluateursEtablissement }} sur {{ $nbEtudiantsEtablissement }} étudiants ont évalué.
                @else
                    Vous n'êtes pas encore associé à un établissement ou aucune évaluation n’a été faite.
                @endif
            </div>
        </div>
    </div>

    {{-- CLASSEMENT DES KPI --}}
    <h2 class="text-primary text-center border border-2 rounded mt-4">Classement des KPI</h2>

    @php
        $labelsPerso = $classements->pluck('kpi.nom')->toArray();
        $labelsGlobal = $moyennes->pluck('kpi.nom')->toArray();
        $allKpis = array_values(array_unique(array_merge($labelsPerso, $labelsGlobal)));
        $baseColors = ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#17a2b8', '#e83e8c', '#6610f2', '#fd7e14'];
        $kpiColorMap = [];
        foreach ($allKpis as $index => $kpiName) {
            $kpiColorMap[$kpiName] = $baseColors[$index % count($baseColors)];
        }
    @endphp

    {{-- KPI PERSONNEL --}}
    <div class="row mt-3">
        <h4 class="text-center">Votre classement des KPI</h4>
        <div class="col-12 col-lg-6 d-flex flex-column">
            @if($classements->isEmpty())
                <div class="text-center">
                    <p>Vous n'avez pas encore classé vos KPI.</p>
                    <a href="{{ route('kpi.classement.create') }}" class="btn btn-primary">Faire le classement</a>
                </div>
            @else
                <div class="table-responsive flex-grow-1">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Rang</th>
                                <th>KPI</th>
                                <th>Poids (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classements as $c)
                                <tr>
                                    <td>{{ $c->rang }}</td>
                                    <td>{{ $c->kpi->nom }}</td>
                                    <td>{{ $c->poids }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
            <canvas id="kpiDoughnutPersonnel" style="max-height: 300px; width: 100%; max-width: 400px;"></canvas>
        </div>
    </div>

    {{-- KPI GLOBAL --}}
    <div class="row mt-4">
        <h4 class="text-center">Poids moyen des KPI (tous étudiants)</h4>
        <div class="col-12 col-lg-6 d-flex flex-column">
            <div class="table-responsive flex-grow-1">
                <table class="table table-bordered table-striped text-center mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Rang</th>
                            <th>KPI</th>
                            <th>Poids moyen (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moyennes as $index => $m)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $m->kpi->nom }}</td>
                                <td>{{ number_format($m->poids_moyen, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
            <canvas id="kpiDoughnutGlobal" style="max-height: 300px; width: 100%; max-width: 400px;"></canvas>
        </div>
    </div>

    {{-- Légende des couleurs --}}
    <div class="mt-4">
        <h5>Légende des couleurs :</h5>
        <ul class="list-inline">
            @foreach ($kpiColorMap as $kpi => $color)
                <li class="list-inline-item me-3">
                    <span class="badge" style="background-color: {{ $color }};">&nbsp;&nbsp;</span>
                    {{ $kpi }}
                </li>
            @endforeach
        </ul>
    </div>

    {{-- CLASSEMENT MENTIONS & ÉTABLISSEMENTS --}}
    <h2 class="text-primary text-center border border-2 rounded mt-5">Classements globaux</h2>
    <div class="row g-4 mt-2">
        {{-- Mentions --}}
        <div class="col-12 col-lg-6">
            <h4 class="text-success">Mentions de votre établissement</h4>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-success">
                    <tr><th>Rang</th><th>Mention</th><th>Note</th></tr>
                </thead>
                <tbody>
                    @foreach ($classementMentions ?? [] as $index => $mention)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mention['mention'] }}</td>
                            <td><span class="badge bg-success">{{ $mention['note'] }}/100</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Établissements --}}
        <div class="col-12 col-lg-6">
            <h4 class="text-danger">Établissements</h4>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-danger">
                    <tr><th>Rang</th><th>Établissement</th><th>Note</th></tr>
                </thead>
                <tbody>
                    @foreach ($classementEtablissements ?? [] as $index => $etab)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $etab['etablissement'] }}</td>
                            <td><span class="badge bg-danger">{{ $etab['note'] }}/100</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- CHART.JS --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const kpiColorMap = @json($kpiColorMap);
        const labelsPerso = @json($classements->pluck('kpi.nom'));
        const dataPerso = @json($classements->pluck('poids'));
        const labelsGlobal = @json($moyennes->pluck('kpi.nom'));
        const dataGlobal = @json($moyennes->pluck('poids_moyen'));

        const commonOptions = {
            cutout: '75%',
            responsive: true,
            plugins: { legend: { display: false } }
        };

        new Chart(document.getElementById('kpiDoughnutPersonnel'), {
            type: 'doughnut',
            data: {
                labels: labelsPerso,
                datasets: [{
                    data: dataPerso,
                    backgroundColor: labelsPerso.map(label => kpiColorMap[label])
                }]
            },
            options: commonOptions
        });

        new Chart(document.getElementById('kpiDoughnutGlobal'), {
            type: 'doughnut',
            data: {
                labels: labelsGlobal,
                datasets: [{
                    data: dataGlobal,
                    backgroundColor: labelsGlobal.map(label => kpiColorMap[label])
                }]
            },
            options: commonOptions
        });
    });
</script>
@endsection
