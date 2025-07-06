<form action="{{ route( isset($mention) && $mention->exists ? 'mentions.update' : 'mentions.store' , $mention) }}" method="POST">
    @csrf
    @method($mention->exists ? 'put' : 'post')

    <div class="mb-3">
        <label for="Libelee" class="form-label">Libélé</label>
        <input type="text" name="Libelee" id="Libelee" class="form-control" value="{{ old('Libelee', $mention->Libelee ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nom de la mention</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $mention->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description de la mention</label>
        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $mention->description ?? '') }}" required>
    </div>

    <div class="mb-3">
        @include('shared.select', [
            'name' => 'Etabli_id',
            'label' => 'Établissement',
            'options' => $etablissements,
            'value' => "{{ old('description', $mention->Etabli_id ?? '') }}"
        ])
    </div>

    <button type="submit" class="btn btn-primary w-100">
        @if ($mention->exists)
            Modifier
        @else
            Ajouter
        @endif
    </button>
</form>