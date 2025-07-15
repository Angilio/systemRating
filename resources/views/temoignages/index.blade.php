@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-primary mb-4">Témoignages & Avis</h1>

    @auth
        <form action="{{ route('temoignages.store') }}" method="POST" class="mb-5">
            @csrf
            <div class="mb-3">
                <input type="text" name="titre" class="form-control" placeholder="Titre du témoignage" required>
            </div>
            <div class="mb-3">
                <textarea name="contenu" class="form-control" rows="4" placeholder="Votre témoignage" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Soumettre</button>
        </form>
    @else
        <p class="text-center text-muted">Connectez-vous pour laisser un témoignage.</p>
    @endauth

    <div class="row">
        @foreach ($temoignages as $temoignage)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        {{ $temoignage->titre }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $temoignage->contenu }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        Par {{ $temoignage->user->name }} le {{ $temoignage->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
