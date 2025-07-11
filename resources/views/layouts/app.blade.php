<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>@yield('title', env('APP_NAME'))</title>
            <link rel="stylesheet" href={{asset('assets/normalize.css')}}>
            <link rel="stylesheet" href={{asset('assets/app.css')}}>
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
        <body>
            <div class="bg-light">
                <div id="head" class="d-flex justify-content-center align-items-center flex-column">
                <img src="{{asset('/assets/images/Una logo.jpg')}}" alt="">
                <h2>Plateformes de notation des établissements.</h2>
                <p>Université d'Antsiranana Madagascar</p>
            </div>
            <header>
                @component('layouts.navbar')
                @endcomponent
            </header>
            <div id="app">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
            <footer>
                <div>
                    <div>
                        <h2>Contact</h2>
                        <p>Université d'Antsiranana</p>
                        <p>BP 0 - Antsiranana 201</p>
                        <p>Madagascar</p>
                        <p>Email: contact@univ-antsiranana.mg</p>
                    </div>
                    <div>
                        <h2>Liens Rapides</h2>
                        <p>Accueil</p>
                        <p>À propos</p>
                        <p>Etablissement</p>
                        <p>Système de Notation</p>
                    </div>
                    <div>
                        <h2>Légal</h2>
                        <p>Condition d'utilisation</p>
                        <p>Politique de confidentialité</p>
                        <p>Mentions légales</p>
                    </div>
                </div>
                <div>
                    <p>&copy; Copyright {{ date('Y') }} - Université d'Antsiranana</p>
                </div>
            </footer>
            </div>
        </body>
</html>
