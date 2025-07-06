@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Liste des KPI</h3>

    <a href="{{ route('kpis.create') }}" class="btn btn-primary mb-3">Ajouter un KPI</a>

    <ul class="list-group">
        @foreach ($kpis as $kpi)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $kpi->nom }}
                <a href="{{ route('kpis.edit', $kpi) }}" class="btn btn-sm btn-warning">Modifier</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection