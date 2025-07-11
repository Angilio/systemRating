@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>Liste des mentions</h1>
        <a href="{{ route('mentions.create') }}" class="btn btn-success mb-3">Ajouter une mention</a>
    </div>

    <div class="row gap-2 d-flex justify-content-center">
        @foreach ($mentions as $mention)
            <div class="card p-3 col-12 col-sm-12 col-md-4 col-lg-3">
                <p>Libelée : <strong>{{ $mention->Libelee }}</strong></p>
                <p>Etablissement : <strong>{{ $mention->etablissement->Libelee }}</strong></p>
                <p>{{ $mention->name }}</p>
                <p>{{ $mention->description }}</p>
                <div class="mt-2">
                    <a href="{{ route('mentions.edit', $mention) }}" class="btn btn-primary btn-sm">Modifier</a>

                    <form action="{{ route('mentions.destroy', $mention) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
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