@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4 text-center">Classement des Indicateurs Clé de Performance (KPI)</h3>

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
            <p>Classez les indicateurs suivants selon l’importance que vous leur accordez pour évaluer la performance d’un établissement.</p>
            <p>Attribuez à chaque indicateur un numéro allant de 1 à 6, où 1 correspond au plus important et 6 au moins important selon vous.</p>
            <p>Chaque chiffre ne peut être utilisé qu’une seule fois. Vous ne devez donc pas attribuer le même rang à plusieurs indicateurs.</p>
            <p>Par exemple, si vous donnez le rang 1 à un indicateur, aucun autre ne peut avoir ce même rang.</p>

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
