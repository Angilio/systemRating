@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Titre principal --}}
    <h1 class="text-primary text-center border border-2 rounded" style="border-radius: 5px;">
        Les notes
    </h1>

    {{-- Trois blocs de note --}}
    <div class="row mt-2 g-3">
        {{-- Note individuelle --}}
        <div class="col-12 col-lg-4">
            @if($noteEtudiant === 0)
                <div class="alert alert-warning h-100">
                    Vous n'avez pas encore effectué votre évaluation. 
                    <a href="{{ route('kpi.classement.create') }}" class="btn btn-sm btn-outline-primary mt-2">Faire l'évaluation</a>
                </div>
            @else
                <div class="alert alert-info h-100">
                    <h4>Votre note d'évaluation : 
                        <span class="badge bg-success fs-5">{{ $noteEtudiant }}/100</span>
                    </h4>
                </div>
            @endif
        </div>

        {{-- Note de la mention --}}
        <div class="col-12 col-lg-4">
            @if($noteMention !== null)
                <div class="alert alert-secondary h-100">
                    <strong>Note de votre mention : </strong>
                    <span class="badge bg-warning text-dark">{{ $noteMention }}/100</span> — 
                    {{ $nbEvaluateursMention }} sur {{ $nbEtudiantsMention }} étudiants ont évalué.
                </div>
            @else
                <div class="alert alert-danger h-100">
                    Vous n'êtes pas encore associé à une mention ou aucune évaluation n’a été faite.
                </div>
            @endif
        </div>

        {{-- Note de l'établissement --}}
        <div class="col-12 col-lg-4">
            @if($noteEtablissement !== null)
                <div class="alert alert-dark h-100">
                    <strong>Note de votre établissement : </strong>
                    <span class="badge bg-dark">{{ $noteEtablissement }}/100</span>
                </div>
            @endif
        </div>
    </div>

    {{-- TITRE --}}
    <h1 class="text-primary text-center border border-2 rounded mt-3" style="border-radius: 5px;">
        Classement des KPI
    </h1>

    {{-- LOGIQUE COULEUR UNIQUE --}}
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

    {{-- Bloc KPI Personnel --}}
    <div class="row g-4 mt-4 align-items-stretch">
        <div class="col-12 col-lg-6">
            <div class="h-100 d-flex flex-column">
                <h2>Votre classement des KPI</h2>
                @if($classements->isEmpty())
                    <p>Vous n'avez pas encore classé vos KPI pour cette année.</p>
                    <a href="{{ route('kpi.classement.create') }}" class="btn btn-primary">Faire le classement</a>
                @else
                    <div class="table-responsive flex-grow-1">
                        <table class="table table-bordered h-100">
                            <thead>
                                <tr>
                                    <th>KPI</th>
                                    <th>Rang</th>
                                    <th>Poids (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classements as $classement)
                                    <tr>
                                        <td>{{ $classement->kpi->nom }}</td>
                                        <td>{{ $classement->rang }}</td>
                                        <td>{{ $classement->poids }} %</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <div>
                    <h2 class="text-center">Doughnut personnel</h2>
                    <canvas id="kpiDoughnutPersonnel" style="max-width: 100%; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Bloc KPI Global --}}
    <div class="row g-4 mt-4 align-items-stretch">
        <div class="col-12 col-lg-6">
            <div class="h-100 d-flex flex-column">
                <h2>Poids moyen des KPI (tous étudiants)</h2>
                <div class="table-responsive flex-grow-1">
                    <table class="table table-bordered table-striped text-center align-middle h-100">
                        <thead class="table-secondary">
                            <tr>
                                <th>Rang</th>
                                <th>KPI</th>
                                <th>Poids moyen (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($moyennes as $index => $moyenne)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $moyenne->kpi->nom }}</td>
                                    <td>{{ number_format($moyenne->poids_moyen, 2) }} %</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="h-100 d-flex justify-content-center align-items-center">
                <div>
                    <h2 class="text-center">Doughnut global</h2>
                    <canvas id="kpiDoughnutGlobal" style="max-width: 100%; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Légende des couleurs --}}
    <div class="mt-4">
        <h5 class="mt-3">Légende des couleurs :</h5>
        <ul class="list-inline">
            @foreach ($kpiColorMap as $kpi => $color)
                <li class="list-inline-item me-4 mb-2">
                    <span class="badge" style="background-color: {{ $color }};">&nbsp;&nbsp;&nbsp;</span>
                    {{ $kpi }}
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Bloc Classement mentions & établissements --}}
<h1 class="text-primary text-center border border-2 rounded mt-3" style="border-radius: 5px;">
    Classement des mentions et des établissements
</h1>
<div class="row g-4 mt-2">

    {{-- Tableau des Mentions --}}
    <div class="col-12 col-lg-6">
        <h4 class="text-success">Classement des Mentions dans votre établissement</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>Rang</th>
                        <th>Mention</th>
                        <th>Note (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classementMentions ?? [] as $index => $mention)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $mention['mention'] }}</td>
                            <td class="text-center">
                                <span class="badge bg-success">{{ $mention['note'] }}/100</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tableau des Établissements --}}
    <div class="col-12 col-lg-6">
        <h4 class="text-danger">Classement des Établissements</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-danger text-center">
                    <tr>
                        <th>Rang</th>
                        <th>Établissement</th>
                        <th>Note (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classementEtablissements ?? [] as $index => $etab)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $etab['etablissement'] }}</td>
                            <td class="text-center">
                                <span class="badge bg-danger">{{ $etab['note'] }}/100</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


</div>

{{-- Scripts --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const kpiColorMap = @json($kpiColorMap);

        const labelsPerso = @json($classements->pluck('kpi.nom'));
        const dataPerso = @json($classements->pluck('poids'));
        const colorsPerso = labelsPerso.map(label => kpiColorMap[label]);

        const labelsGlobal = @json($moyennes->pluck('kpi.nom'));
        const dataGlobal = @json($moyennes->pluck('poids_moyen'));
        const colorsGlobal = labelsGlobal.map(label => kpiColorMap[label]);

        const commonOptions = {
            cutout: '80%',
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            }
        };

        new Chart(document.getElementById('kpiDoughnutPersonnel'), {
            type: 'doughnut',
            data: {
                labels: labelsPerso,
                datasets: [{
                    data: dataPerso,
                    backgroundColor: colorsPerso
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
                    backgroundColor: colorsGlobal
                }]
            },
            options: commonOptions
        });
    });
</script>
@endsection
