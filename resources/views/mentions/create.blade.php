@extends('layouts.app')
@section('title' , $mention->exists ? 'Modifier une mention' : 'Créer une nouvelle mention')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3">Ajouter une mention</h1>
        <a href="{{ route('mentions.index') }}" class="btn btn-primary">Listes des mentions</a>
    </div>
    <div id="login">
        @include('mentions._form')
    </div>
</div>
@endsection