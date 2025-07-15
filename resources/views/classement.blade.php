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

        {{-- Tableau rangé --}}
        <div class="table-responsive mt-3">
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

        {{-- Graphiques --}}
        @if ($data['graph'])
            <div class="chart-wrapper mt-3">
                <div class="chart-container aspect-ratio-square">
                    <canvas id="doughnut-{{ Str::slug($etabName) }}"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="bar-{{ Str::slug($etabName) }}"></canvas>
                </div>
            </div>

            {{-- Légende --}}
            <div class="mt-3 d-flex flex-wrap">
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
    .chart-wrapper {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        gap: 1rem;
    }

    .chart-container {
        flex: 1 1 300px;
        position: relative;
    }

    .aspect-ratio-square {
        aspect-ratio: 1 / 1;
    }

    .chart-container canvas {
        width: 100% !important;
        height: 100% !important;
    }
</style>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                            legend: { position: 'bottom' }
                        },
                        cutout: '80%'
                    }
                });

                new Chart(document.getElementById("bar-{{ Str::slug($etabName) }}"), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($data['labels']) !!},
                        datasets: [{
                            label: 'Note (%)',
                            data: {!! json_encode($data['scores']) !!},
                            backgroundColor: '#0d6efd'
                        }]
                    },
                    options: {
                        responsive: true,
                        indexAxis: 'y',
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100
                            }
                        }
                    }
                });
            @endif
        @endforeach
    });
</script>
@endsection
