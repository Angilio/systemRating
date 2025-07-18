@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
            <div class="text-center">
                <button type="submit" class="btn btn-success">Soumettre</button>
            </div>
        </form>
    @else
        <p class="text-center text-muted">Connectez-vous pour laisser un témoignage.</p>
    @endauth

    <div class="row">
        @foreach ($temoignages as $temoignage)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4"> {{-- responsive : 1-1-2-3 --}}
                <div class="card h-100 shadow-sm">
                    
                   {{-- Image utilisateur s’il a une photo de profil --}}
                    @if($temoignage->user->profil)
                        <img src="{{ asset('storage/' . $temoignage->user->profil) }}" 
                            class="card-img-top" 
                            alt="Photo de {{ $temoignage->user->name }}" 
                            style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex justify-content-center align-items-center bg-light" style="height: 250px;">
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">
                            {{ Str::limit($temoignage->titre, 100) }}
                        </h5>
                        <p class="card-text text-muted fst-italic">
                            {{ Str::limit($temoignage->contenu, 200) }}
                        </p>
                        {{-- <a href="{{ route('temoignages.show', $temoignage) }}" class="btn btn-primary btn-sm">Détails</a> --}}
                    </div>

                    <div class="card-footer text-muted text-end small">
                        Par <strong>{{ $temoignage->user->name . ' ' . $temoignage->user->prenoms }}</strong> 
                        le {{ $temoignage->created_at->format('d/m/Y') }} - {{ $temoignage->user->mention->Libelee ?? 'Mention inconnue' }},
        {{ $temoignage->user->etablissement->Libelee ?? 'Établissement inconnu' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
