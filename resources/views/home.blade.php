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

    <h2 class="mt-5">Classement général (Moyenne des rangs et pourcentage)</h2>

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


    @if($noteEtudiant === 0)
        <div class="alert alert-warning">
            Vous n'avez pas encore effectué votre évaluation. 
            <a href="{{ route('evaluation.index') }}" class="btn btn-sm btn-outline-primary">Faire l'évaluation</a>
        </div>
    @else
        <div class="alert alert-info mt-4">
            <h4 class="mb-0">Votre note d'évaluation : <span class="badge bg-success">{{ $noteEtudiant }}/100</span></h4>
        </div>
    @endif
    

    @if($noteMention !== null)
        <div class="alert alert-warning">
            Note de votre mention : <strong>{{ $noteMention }}/100</strong>
        </div>
    @else
        <div class="alert alert-danger">
            Vous n'êtes pas encore associé à une mention.
        </div>
    @endif

    <h4 class="mt-4 text-success">Classement des Mentions dans votre établissement</h4>
    <ol class="list-group list-group-numbered">
        @foreach ($classementMentions as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item['mention'] }}
                <span class="badge bg-success rounded-pill">{{ $item['note'] }}/100</span>
            </li>
        @endforeach
    </ol>

    <h4 class="mt-4 text-danger">Classement des Établissements (basé sur les évaluations)</h4>
    <ol class="list-group list-group-numbered">
        @foreach ($classementEtablissements as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item['etablissement'] }}
                <span class="badge bg-danger rounded-pill">{{ $item['note'] }}/100</span>
            </li>
        @endforeach
    </ol>

</div>
@endsection

