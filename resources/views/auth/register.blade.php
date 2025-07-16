@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter un étudiant') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nom') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prenoms" class="form-label">{{ __('Prénoms') }}</label>
                            <input id="prenoms" type="text" class="form-control @error('prenoms') is-invalid @enderror"
                                   name="prenoms" value="{{ old('prenoms') }}" autocomplete="prenoms">
                            @error('prenoms')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="etablissementSelect" class="form-label">{{ __('Établissement') }}</label>
                            <select name="etablissement_id" id="etablissementSelect"
                                    class="form-select @error('etablissement_id') is-invalid @enderror" required>
                                <option value="">-- Choisir un établissement --</option>
                                @foreach ($etablissements as $etab)
                                    <option value="{{ $etab->id }}">{{ $etab->Libelee }}</option>
                                @endforeach
                            </select>
                            @error('etablissement_id')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="niveau" class="form-label">Niveau</label>
                            <select name="niveau" id="niveau"
                                    class="form-select @error('niveau') is-invalid @enderror" required>
                                <option value="">-- Choisir le niveau --</option>
                                <option value="L1">L1</option>
                                <option value="L2">L2</option>
                                <option value="L3">L3</option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="Sortant">Sortant</option>
                            </select>
                            @error('niveau')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mentionSelect" class="form-label">{{ __('Mention') }}</label>
                            <select name="mention_id" id="mentionSelect"
                                    class="form-select @error('mention_id') is-invalid @enderror" required>
                                <option value="">-- Choisir une mention --</option>
                            </select>
                            @error('mention_id')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Adresse Email') }}</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="w-100 btn btn-primary">
                                {{ __('Enregistrer l\'étudiant') }}
                            </button>
                        </div>
                    </form>

                    <p class="mt-3"><small><a href="{{ route('login') }}">{{ __('Retour à la connexion') }}</a></small></p>
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
