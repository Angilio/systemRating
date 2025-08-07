@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <h3 class="text-info">Taux de réussite annuel</h3>
        <a href="{{ route('taux.create')}}" class="btn btn-success">Ajouter un taux de réussite</a>
    </div>

    @foreach($etablissements as $etabData)
        @php
            $etab = $etabData['etablissement'];
            $mentions = $etabData['mentions'];
            $tauxGlobal = $etabData['taux_count'] > 0
                ? number_format($etabData['taux_total'] / $etabData['taux_count'], 2)
                : 'N/A';
        @endphp

        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <strong>{{ $etab->Libelee }}</strong>
                <span>
                    Taux global : <strong>{{ $tauxGlobal }}%</strong>
                </span>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mention</th>
                            <th>Taux moyen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mentions as $mentionData)
                            @php
                                $mention = $mentionData['mention'];
                                $tauxMoyen = $mentionData['taux_count'] > 0
                                    ? number_format($mentionData['taux_sum'] / $mentionData['taux_count'], 2)
                                    : 'N/A';
                            @endphp
                            <tr>
                                <td>{{ $mention->Libelee }}</td>
                                <td>{{ $tauxMoyen }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection
