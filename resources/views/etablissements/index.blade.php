@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
        <h1>Liste des établissements</h1>
        <a href="{{ route('etablissements.create') }}" class="btn btn-success mb-3">Ajouter un établissement</a>
    </div>

    @foreach ($etablissements as $etablissement)
        <div class="card mb-2 p-3">
            @if($etablissement->logo)
                <img src="{{ asset('storage/' . $etablissement->logo) }}" alt="Logo" width="120">
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
@endsection