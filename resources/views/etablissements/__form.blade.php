<form action="{{ isset($etablissement) ? route('etablissements.update', $etablissement) : route('etablissements.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($etablissement))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="Libelee" class="form-label">Libelé</label>
        <input type="text" name="Libelee" id="Libelee" class="form-control" value="{{ old('Libelee', $etablissement->Libelee ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $etablissement->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $etablissement->description ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">

        @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if (isset($etablissement) && $etablissement->logo)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $etablissement->logo) }}" alt="Logo actuel" width="100">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary w-100">
        {{ isset($etablissement) ? 'Modifier' : 'Ajouter' }}
    </button>
</form>