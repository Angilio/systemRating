@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-primary border border-2 rounded p-2">Classement des Établissements</h1>

    {{-- Établissements --}}
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-primary">
                <tr>
                    <th>Rang</th>
                    <th>Établissement</th>
                    <th>Note (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classementEtablissements as $etab)
                    <tr>
                        <td>{{ $etab['rang'] }}</td>
                        <td>{{ $etab['etablissement'] }}</td>
                        <td>
                            @if ($etab['note'] !== null)
                                <span class="badge bg-primary">{{ $etab['note'] }}/100</span>
                            @else
                                <span class="text-muted">/100</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mentions par établissement --}}
    <hr class="my-5">
    <h1 class="text-center text-primary border border-2 rounded p-2">Classement des Mentions par Établissement</h1>

    @foreach ($classementParEtablissement as $etabName => $data)
        <h3 class="text-success mt-5">{{ $etabName }}</h3>

        @if ($data['graph'])
        <div class="row align-items-stretch">
            {{-- Tableau --}}
            <div class="col-md-8">
                <div class="table-responsive mt-3 mt-md-0">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-success">
                            <tr>
                                <th>Rang</th>
                                <th>Nom de la Mention</th>
                                <th>Note (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['tableau'] as $mention)
                                <tr>
                                    <td>{{ $mention['rang'] }}</td>
                                    <td>{{ $mention['nom'] }}</td>
                                    <td>
                                        @if ($mention['note'] !== null)
                                            <span class="badge bg-success">{{ $mention['note'] }}/100</span>
                                        @else
                                            <span class="text-muted">/100</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Doughnut Chart avec une seule légende --}}
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <div class="chart-container-doughnut">
                    <canvas id="doughnut-{{ Str::slug($etabName) }}"></canvas>
                </div>
            </div>
        </div>

        {{-- Légende en dessous du graphique --}}
        <div class="mt-3 d-flex flex-wrap justify-content-center">
            @foreach ($data['labels'] as $i => $label)
                <div class="me-3 mb-2 d-flex align-items-center">
                    <span class="badge me-2" style="background-color: {{ $colors[$i % count($colors)] }};">&nbsp;&nbsp;</span>
                    <small>{{ $label }}</small>
                </div>
            @endforeach
        </div>
        @else
            <div class="alert alert-warning mt-3">Certaines mentions n'ont pas encore reçu de note. Graphique indisponible.</div>
        @endif
    @endforeach
</div>

{{-- STYLES --}}
<style>
    .chart-container-doughnut {
        width: 250px;
        height: 250px;
        position: relative;
    }

    .chart-container-doughnut canvas {
        width: 100% !important;
        height: 100% !important;
    }

    @media (max-width: 768px) {
        .chart-container-doughnut {
            margin-top: 20px;
        }
    }
</style>

{{-- Chart.js --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const colors = ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#ff6b6b', '#6c757d'];

        @foreach ($classementParEtablissement as $etabName => $data)
            @if ($data['graph'])
                new Chart(document.getElementById("doughnut-{{ Str::slug($etabName) }}"), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($data['labels']) !!},
                        datasets: [{
                            data: {!! json_encode($data['scores']) !!},
                            backgroundColor: colors,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        cutout: '75%'
                    }
                });
            @endif
        @endforeach
    });
</script>
@endsection
