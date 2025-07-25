@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4 text-center">Classement des Indicateurs de Performance (KPI)</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (!empty($dejaClasse) && $dejaClasse)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Vous avez déjà effectué le classement des KPI pour cette année.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Aller au tableau de bord</a>
    @else
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur !</strong> Veuillez corriger les champs suivants :
                <ul class="m-0 p-0 list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div id="login" class="container">
            <p>Classez les KPI de 1 (le plus important) à 6 (le moins important). Chaque rang doit être unique.</p>
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

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Valider le classement</button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection
