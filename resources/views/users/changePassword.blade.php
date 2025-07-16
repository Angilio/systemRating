@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Changer le mot de passe</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="mb-3">
            <label>Mot de passe actuel</label>
            <input type="password" name="current_password" class="form-control" required>
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Nouveau mot de passe</label>
            <input type="password" name="new_password" class="form-control" required>
            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Confirmer le nouveau mot de passe</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Valider le changement</button>
    </form>
</div>
@endsection
