@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ajouter un taux de réussite</h3>
    <form id="login" method="POST" action="{{ route('taux.store') }}">
        @csrf
        <div class="mb-3">
            <label for="mention_id" class="form-label">Mention</label>
            <select class="form-select" id="mention_id" name="mention_id" required>
                @foreach($mentions as $mention)
                    <option value="{{ $mention->id }}">{{ $mention->Libelee }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="taux" class="form-label">Taux de réussite (%)</label>
            <input type="number" class="form-control" id="taux" name="taux" step="0.1" min="0" max="100" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Valider</button>
        </div>
    </form>
</div>
@endsection