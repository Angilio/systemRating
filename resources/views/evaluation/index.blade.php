@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="h1 text-info text-center">Evaluer la qualité de votre mention</h3>

    @if (!empty($dejaEvalue) && $dejaEvalue)
        <div class="alert alert-info">
            Vous avez déjà rempli l'évaluation pour cette année.
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Aller au tableau de bord</a>
    @else
        <form method="POST" action="{{ route('evaluation.store') }}">
            @csrf

            @php
                $groupes = $questions->groupBy('kpi_id');
            @endphp

            @foreach ($groupes as $kpiId => $questionsKpi)
                <h4 class="mt-3 fw-bold bg-success text-white text-center p-2 border border-2 rounded">
                    {{ $questionsKpi->first()->kpi->nom }}
                </h4>

                @foreach ($questionsKpi as $question)
                    <div class="mb-4">
                        <strong>{{ $question->intitule }}</strong><br>

                        @if($question->type === 'choix')
                            @foreach($question->options as $option)
                                <label>
                                    <input type="radio" name="reponses[{{ $question->id }}]" value="{{ $option->id }}" required>
                                    {{ $option->texte }}
                                </label><br>
                            @endforeach
                        @else
                            <textarea name="reponses[{{ $question->id }}]" class="form-control" required></textarea>
                        @endif
                    </div>
                @endforeach
            @endforeach

            <button class="btn btn-primary">Soumettre</button>
        </form>
    @endif
</div>
@endsection
