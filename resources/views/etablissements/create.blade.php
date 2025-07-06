@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
            <h1>Ajouter un établissement</h1>
            <a href="{{ route('etablissements.index') }}" class="btn btn-success mb-3">Les établissements</a>
        </div>
        <div id="login">
            <h2>Nouveau établissement</h2>
            @include('etablissements.__form')
        </div>
    </div>
@endsection
