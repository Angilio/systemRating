@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mt-4 text-primary">Votre classement des KPI</h2>

    @if($classements->isEmpty())
        <p>Vous n'avez pas encore classé vos KPI pour cette année.</p>
        <a href="{{ route('kpi.classement.create') }}" class="btn btn-primary">Faire le classement</a>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
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

    <h2 class="mt-5">Poids moyen des KPI (tous étudiants)</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
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

    {{-- Note individuelle --}}
    @if($noteEtudiant === 0)
        <div class="alert alert-warning mt-4">
            Vous n'avez pas encore effectué votre évaluation. 
            <a href="{{ route('evaluation.questions') }}" class="btn btn-sm btn-outline-primary">Faire l'évaluation</a>
        </div>
    @else
        <div class="alert alert-info mt-4">
            <h4>Votre note d'évaluation : 
                <span class="badge bg-success fs-5">{{ $noteEtudiant }}/100</span>
            </h4>
        </div>
    @endif

    {{-- Note de la mention --}}
    @if($noteMention !== null)
        <div class="alert alert-secondary mt-4">
            <strong>Note de votre mention : </strong>
            <span class="badge bg-warning text-dark">{{ $noteMention }}/100</span> —
            {{ $nbEvaluateursMention }} sur {{ $nbEtudiantsMention }} étudiants ont évalué.
        </div>
    @else
        <div class="alert alert-danger mt-4">
            Vous n'êtes pas encore associé à une mention ou aucune évaluation n’a été faite.
        </div>
    @endif

    {{-- Note de l'établissement --}}
    @if($noteEtablissement !== null)
        <div class="alert alert-dark mt-4">
            <strong>Note de votre établissement : </strong>
            <span class="badge bg-dark">{{ $noteEtablissement }}/100</span>
        </div>
    @endif

    {{-- Classement des mentions --}}
    <h4 class="mt-5 text-success">Classement des Mentions dans votre établissement</h4>
    <ol class="list-group list-group-numbered">
        @foreach ($classementMentions ?? [] as $mention)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $mention['mention'] }}
                <span class="badge bg-success rounded-pill">{{ $mention['note'] }}/100</span>
            </li>
        @endforeach
    </ol>

    {{-- Classement des établissements --}}
    <h4 class="mt-5 text-danger">Classement des Établissements</h4>
    <ol class="list-group list-group-numbered">
        @foreach ($classementEtablissements ?? [] as $etab)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $etab['etablissement'] }}
                <span class="badge bg-danger rounded-pill">{{ $etab['note'] }}/100</span>
            </li>
        @endforeach
    </ol>

</div>
@endsection
