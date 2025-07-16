@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>Liste des mentions</h1>
        <a href="{{ route('mentions.create') }}" class="btn btn-success mb-3">Ajouter une mention</a>
    </div>

    <div class="row gap-2 d-flex justify-content-center">
        @foreach ($mentions as $mention)
            <div class="card p-3 col-12 col-sm-12 col-md-4 col-lg-3">
                <p>Libellé : <strong>{{ $mention->Libelee }}</strong></p>
                <p>Établissement : <strong>{{ $mention->etablissement->Libelee }}</strong></p>
                <p>{{ $mention->name }}</p>
                <p>{{ $mention->description }}</p>

                <div class="mt-2">
                    <a href="{{ route('mentions.edit', $mention) }}" class="btn btn-primary btn-sm">Modifier</a>

                    <!-- 🗑️ Bouton déclencheur du modal -->
                    <button class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteMentionModal"
                            data-id="{{ $mention->id }}"
                            data-name="{{ $mention->Libelee }}">
                        Supprimer
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- ✅ Modal Bootstrap -->
<div class="modal fade" id="confirmDeleteMentionModal" tabindex="-1" aria-labelledby="confirmDeleteMentionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteMentionForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteMentionModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la mention <strong><span id="mentionName"></span></strong> ?</p>
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
    const deleteMentionModal = document.getElementById('confirmDeleteMentionModal');
    deleteMentionModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const mentionId = button.getAttribute('data-id');
        const mentionName = button.getAttribute('data-name');

        const modalMentionName = deleteMentionModal.querySelector('#mentionName');
        modalMentionName.textContent = mentionName;

        const form = deleteMentionModal.querySelector('#deleteMentionForm');
        form.action = '/mentions/' + mentionId;
    });
</script>
@endsection
