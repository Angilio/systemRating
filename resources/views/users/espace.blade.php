@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Espace étudiant</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <div class="row align-items-start">
            <!-- Partie image - prend 6 colonnes sur 12 -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                @if($user->profil)
                    <img src="{{ asset('storage/' . $user->profil) }}" alt="Profil" class="img-thumbnail" style="max-width: 100%;">
                @else
                    <p>Aucune photo de profil</p>
                @endif

                <form action="{{ route('etudiant.photo') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <div class="mb-2">
                        <input type="file" name="profil" id="profil" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Changer photo</button>
                </form>
            </div>

            <!-- Partie infos - prend 6 colonnes sur 12 -->
            <div class="col-md-6">
                <h4>Informations personnelles</h4>
                <p><strong>Nom :</strong> {{ $user->name }}</p>
                <p><strong>Prénoms :</strong> {{ $user->prenoms }}</p>
                <p><strong>Email :</strong> {{ $user->email }}</p>
                <p><strong>Rôle :</strong> {{ $user->getRoleNames()->first() }}</p>
                <p><strong>Établissement :</strong> {{ $user->etablissement ? $user->etablissement->name : 'Non défini' }}</p>
                <p><strong>Mention :</strong> {{ $user->mention ? $user->mention->name : 'Non défini' }}</p>
                <p><strong>Niveau d’étude :</strong> {{ $user->niveau }}</p>                
            </div>
        </div>
    </div>
</div>
@endsection
