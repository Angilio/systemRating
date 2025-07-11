@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Votre classement des KPI</h2>

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
    <h4 class="mt-5">Classement général (Moyenne des rangs et pourcentage)</h4>

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
</div>
@endsection

