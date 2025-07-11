@extends('layouts.app')

@section('title', 'Bienvenue')

@section('content')
<div id="home">
    <div id="hommeImg" class="text-center">
        <h1>Évaluez la Qualité de Votre Formation</h1>
        <p>Bienvenue sur la plateforme officielle de notation des établissements de l'Université d'Antsiranana. Partagez votre expérience, consultez les avis et contribuez à l'amélioration continue de nos services éducatifs.</p>
        <a href="{{ auth()->check() ? route('kpi.classement.create') : route('login') }}" class="btn btn-success">
            Commencer à noter
        </a>
    </div>

    <div>
        <h2>À Propos de Notre Plateforme</h2>
        <p>Cette plateforme a été créée pour offrir aux étudiants, anciens étudiants et personnels de l'Université d'Antsiranana un espace dédié pour évaluer la qualité des enseignements, des infrastructures et des services offerts par nos différents établissements. Notre objectif est de :</p>
        <ul>
            <li>Favoriser la transparence dans l'évaluation de nos établissements</li>
            <li>Impliquer la communauté universitaire dans un processus d'amélioration continue</li>
            <li>Guider les futurs étudiants dans leur choix d'orientation</li>
            <li>Établir un dialogue constructif entre administration, corps enseignant et étudiants</li>
        </ul>
        <p>Vos avis comptent et contribuent directement à l'évolution positive de notre université.</p>
    </div>

    <div>
        <h2>Histoire de l'Université d'Antsiranana</h2>
        <p>L'Université d'Antsiranana (UNA), située dans la ville de Diego-Suarez au nord de Madagascar, a été fondée en 1976 sous le nom de Centre Universitaire Régional (CUR) d'Antsiranana. Elle est devenue officiellement une université à part entière en 1988. <br>
        Au fil des années, l'UNA s'est développée pour devenir l'un des principaux centres d'enseignement supérieur de Madagascar, avec une vision axée sur l'excellence académique, la recherche appliquée et le développement durable de la région nord de Madagascar. <br>
        Aujourd'hui, l'université compte neuf établissements, offrant une variété de formations dans des domaines aussi divers que les sciences et technologies, les lettres et sciences humaines, l'économie et la gestion, la médecine, l'environnement et l'agronomie.</p>
    </div>

    <div>
        <h2>Nos Établissements</h2>
        <p>L'Université d'Antsiranana comprend 9 établissements répartis en 3 écoles, 4 facultés et 2 instituts, chacun offrant des formations spécialisées dans divers domaines.</p>
        <div id="carte">
            @foreach ($etablissements as $etablissement)
                <div id="item" class="card">
                    @if ($etablissement->logo)
                        <div id="ItemHead" class="card-header d-flex justify-content-center align-items-center bg-light">
                            <img src="{{ asset('storage/' . $etablissement->logo) }}"
                                alt="Logo {{ $etablissement->name }}">
                        </div>
                    @else
                        <div class="text-center py-5 bg-light">Pas de logo</div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $etablissement->name }}</h5>
                        <p class="card-text text-muted">{{ $etablissement->description }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-dark mt-auto">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h2>Comment Fonctionne Notre Système de Notation</h2>
        <p>Notre plateforme permet aux utilisateurs d'évaluer les établissements selon plusieurs critères importants :</p>
        <ul>
            <li>Qualité des cours et pédagogie</li>
            <li>Pertinance des programmes</li>
            <li>Infrastructures et ressources disponibles</li>
            <li>Satisfaction des étudiants</li>
            <li>Taux de réussite</li>
            <li>Organisation et accompagnement</li>
        </ul>
        <p>
            Chaque critère est évalué sur une échelle de 1 à 5 étoiles, et les utilisateurs peuvent laisser des commentaires détaillés pour partager leur expérience. <br>
            Pour garantir la transparence et la fiabilité des évaluations, notre système vérifie l'authenticité des utilisateurs avant la publication des avis.
        </p>
        <a href="{{ auth()->check() ? route('kpi.classement.create') : route('login') }}" class="btn btn-success">
            Commencer à noter
        </a>
    </div>
</div>

@endsection
