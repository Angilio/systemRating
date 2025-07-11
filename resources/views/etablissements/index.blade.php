@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
        <h1>Liste des établissements</h1>
        <a href="{{ route('etablissements.create') }}" class="btn btn-success mb-3">Ajouter un établissement</a>
    </div>

    <div class="row d-flex justify-content-center gap-2">
        @foreach ($etablissements as $etablissement)
            <div class="card p-3 col-12 col-sm-12 col-md-4 col-lg-3">
                @if($etablissement->logo)
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('storage/' . $etablissement->logo) }}" alt="Logo" width="120">
                    </div>
                @endif
                <strong>{{ $etablissement->Libelee }}</strong><br>
                <strong>{{ $etablissement->name }}</strong><br>
                <p>{{ $etablissement->description }}</p>

                <div class="mt-2">
                    <a href="{{ route('etablissements.edit', $etablissement) }}" class="btn btn-primary btn-sm">Modifier</a>

                    <form action="{{ route('etablissements.destroy', $etablissement) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection