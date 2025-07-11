@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Evaluer la qualité de votre mention.</h3>

        <form method="POST" action="{{ route('evaluation.store') }}">
            @csrf

            @php
                // Regrouper les questions par KPI
                $groupes = $questions->groupBy('kpi_id');
            @endphp

            @foreach ($groupes as $kpiId => $questionsKpi)
                <h4 class="mt-5 fw_bold bg-success text-white text-center p-2">{{ $questionsKpi->first()->kpi->nom }}</h4>
                
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
    </div>
@endsection