@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4>Modifier le KPI</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('kpis.update', $kpi) }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nom">Nom de l'indicateur</label>
                    <input type="text" name="nom" class="form-control" value="{{ $kpi->nom }}" required>
                </div>

                <button class="btn btn-success">Mettre à jour</button>
                <a href="{{ route('kpis.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
