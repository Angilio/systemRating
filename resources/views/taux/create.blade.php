@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <h3 class="text-info">Ajouter un taux de réussite</h3>
        <a href="{{ route('taux.index')}}" class="btn btn-success">Taux de réussite annuel</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <form id="login" method="POST" action="{{ route('taux.store') }}">
        @csrf

        <div class="mb-3">
            <label for="etablissement_id" class="form-label">Établissement</label>
            <select class="form-select" id="etablissement_id" name="etablissement_id" required>
                <option value="">-- Choisir --</option>
                @foreach($etablissements as $etab)
                    <option value="{{ $etab->id }}">{{ $etab->Libelee }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mention_id" class="form-label">Mention</label>
            <select class="form-select" id="mention_id" name="mention_id" required>
                <option value="">-- Choisir un établissement d’abord --</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="taux" class="form-label">Taux de réussite (%)</label>
            <input type="number" class="form-control" id="taux" name="taux" step="0.1" min="0" max="100" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('etablissement_id').addEventListener('change', function () {
    const etabId = this.value;
    const mentionSelect = document.getElementById('mention_id');

    if (etabId === '') {
        mentionSelect.innerHTML = '<option value="">-- Choisir un établissement d’abord --</option>';
        return;
    }

    fetch('/api/mentions?etablissement_id=' + etabId)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">-- Choisir une mention --</option>';
            data.forEach(mention => {
                options += `<option value="${mention.id}">${mention.Libelee}</option>`;
            });
            mentionSelect.innerHTML = options;
        })
        .catch(err => {
            console.taux('Erreur chargement des mentions', err);
            mentionSelect.innerHTML = '<option value="">Erreur de chargement</option>';
        });
});
</script>
@endsection
