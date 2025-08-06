@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center text-info">Changer mon mot de passe</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form id="login" method="POST" action="{{ route('password.update') }}">
        @csrf

        {{-- MOT DE PASSE ACTUEL --}}
        <div class="mb-3">
            <label for="current_password" class="form-label">Mot de passe actuel</label>
            <div class="input-group">
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror"
                    name="current_password">
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                    <i class="bi bi-eye-slash"></i>
                </button>
            </div>
            @error('current_password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        {{-- NOUVEAU MOT DE PASSE --}}
        <div class="mb-3">
            <label for="new_password" class="form-label">Nouveau mot de passe</label>
            <div class="input-group">
                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror"
                    name="new_password">
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password">
                    <i class="bi bi-eye-slash"></i>
                </button>
            </div>
            @error('new_password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        {{-- CONFIRMATION --}}
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
            <div class="input-group">
                <input id="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
                    name="new_password_confirmation">
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="new_password_confirmation">
                    <i class="bi bi-eye-slash"></i>
                </button>
            </div>
            @error('new_password_confirmation')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Mettre à jour mon mot de passe</button>
        </div>
    </form>
</div>
<script>
    // Pour tous les boutons avec la classe toggle-password
    document.querySelectorAll('.toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const inputId = this.getAttribute('data-target');
            const input = document.getElementById(inputId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    });
</script>
@endsection
