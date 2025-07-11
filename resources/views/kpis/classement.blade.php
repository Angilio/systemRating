@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Classement des Indicateurs de Performance (KPI)</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur !</strong> Veuillez corriger les champs suivants :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>Classez les KPI de 1 (le plus important) à 6 (le moins important). Chaque rang doit être unique.</p>

    <div id="login">
        <h3>Rangement de KPI</h3>
        <form action="{{ route('kpi.classement.store') }}" method="POST">
            @csrf

            @foreach ($kpis as $kpi)
                <div class="form-group mb-3">
                    <label for="rang_{{ $kpi->id }}">{{ $kpi->nom }}</label>
                    <input
                        type="number"
                        name="rang[{{ $kpi->id }}]"
                        id="rang_{{ $kpi->id }}"
                        class="form-control"
                        min="1"
                        max="6"
                        required
                    >
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Valider le classement</button>
        </form>
    </div>
</div>
@endsection
