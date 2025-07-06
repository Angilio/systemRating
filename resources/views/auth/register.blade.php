@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label text-md-end">{{ __('Name') }}</label>
                            <div class="w-100">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="prenoms" class="form-label text-md-end">{{ __('First name') }}</label>
                            <div class="w-100">
                                <input id="prenoms" type="text" class="form-control @error('prenoms') is-invalid @enderror" name="prenoms" value="{{ old('prenoms') }}"  autocomplete="prenoms" autofocus>
                                @error('prenoms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Établissement -->
                        <div>
                            <label for="etablissementSelect" class="form-label text-md-end">{{ __('Etabishement') }}</label>
                            <select  name="etablissement_id" id="etablissementSelect" class="form-select mb-2" required>
                                <option value="">-- Choisir un établissement --</option>
                                @foreach ($etablissements as $etab)
                                    <option value="{{ $etab->id }}">{{ $etab->Libelee }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="niveau">Niveau</label>
                            <select name="niveau" id="niveau" class="form-control" required>
                                <option value="">-- Choisir le niveau --</option>
                                <option value="L1">L1</option>
                                <option value="L2">L2</option>
                                <option value="L3">L3</option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="Sortant">Sortant</option>
                            </select>
                        </div>

                        <!-- Mention -->
                        <div>
                            <label for="mentionSelect" class="form-label text-md-end">{{ __('Mention') }}</label>
                            <select name="mention_id" id="mentionSelect" class="form-select mb-3" required>
                                <option value="">-- Choisir une mention --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="w-100">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-md-end">{{ __('Password') }}</label>
                            <div class="w-100">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="w-100">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="">
                                <button type="submit" class="w-100 btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="mt-3"><small>Déjà un compte? <a href="{{ route('login') }}">{{ __('Login') }}</a></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const etablissementSelect = document.getElementById('etablissementSelect');
        const mentionSelect = document.getElementById('mentionSelect');

        etablissementSelect.addEventListener('change', function () {
            const etabId = this.value;

            if (!etabId) {
                mentionSelect.innerHTML = '<option value="">-- Choisir une mention --</option>';
                return;
            }

            fetch(`/api/mentions?etablissement_id=${etabId}`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur de réponse");
                    return response.json();
                })
                .then(data => {
                    mentionSelect.innerHTML = '<option value="">-- Choisir une mention --</option>';
                    data.forEach(mention => {
                        const option = document.createElement('option');
                        option.value = mention.id;
                        option.textContent = mention.Libelee;
                        mentionSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des mentions :', error);
                });
        });
    });
</script>


