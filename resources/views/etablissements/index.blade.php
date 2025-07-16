@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
        <h1>Liste des établissements</h1>
        <a href="{{ route('etablissements.create') }}" class="btn btn-success mb-3">Ajouter un établissement</a>
    </div>

    <div class="row d-flex justify-content-center gap-2">
        @foreach ($etablissements as $etablissement)
            <div class="card p-3 col-12 col-sm-12 col-md-4 col-lg-3">
                @if($etablissement->logo)
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('storage/' . $etablissement->logo) }}" alt="Logo" width="120">
                    </div>
                @endif
                <strong>{{ $etablissement->Libelee }}</strong><br>
                <strong>{{ $etablissement->name }}</strong><br>
                <p>{{ $etablissement->description }}</p>

                <div class="mt-2">
                    <a href="{{ route('etablissements.edit', $etablissement) }}" class="btn btn-primary btn-sm">Modifier</a>

                    <!-- 🗑️ Bouton qui déclenche le modal -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal"
                            data-id="{{ $etablissement->id }}"
                            data-name="{{ $etablissement->name }}">
                        Supprimer
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- ✅ Modal de confirmation -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteEtablissementForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer l’établissement <strong id="etablissementName"></strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const etablissementId = button.getAttribute('data-id');
        const etablissementName = button.getAttribute('data-name');

        const modalBodyName = confirmDeleteModal.querySelector('#etablissementName');
        modalBodyName.textContent = etablissementName;

        const form = confirmDeleteModal.querySelector('#deleteEtablissementForm');
        form.action = '/etablissements/' + etablissementId;
    });
</script>
@endsection
