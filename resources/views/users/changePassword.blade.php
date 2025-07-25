@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Changer mon mot de passe</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="login">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Mot de passe actuel</label>
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror"
                    name="current_password" required>
                @error('current_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">Nouveau mot de passe</label>
                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror"
                    name="new_password" required>
                @error('new_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                <input id="new_password_confirmation" type="password" class="form-control"
                    name="new_password_confirmation" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Mettre à jour mon mot de passe</button>
            </div>
        </form>
    </div>
</div>
@endsection
