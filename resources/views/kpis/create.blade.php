@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Ajouter un KPI</h4>
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

            <form method="POST" action="{{ route('kpis.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="nom">Nom de l'indicateur</label>
                    <input type="text" name="nom" class="form-control" required placeholder="ex : Qualité des cours et pédagogie">
                </div>

                <button class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('kpis.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
