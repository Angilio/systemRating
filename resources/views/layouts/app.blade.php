<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', env('APP_NAME'))</title>

        <link rel="stylesheet" href="{{ asset('assets/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
        <script src="{{ asset('assets/chart.min.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <link href="{{ asset('assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">

    </head>
    <body>
        <div class="bg-light">
            <div id="head" class="d-flex justify-content-center align-items-center flex-column flex-lg-row text-center text-lg-start gap-4 p-4">
                <img src="{{ asset('/assets/images/Una logo.jpg') }}" alt="Logo UNA" class="img-fluid" style="max-width: 200px;">
                
                <div>
                    <h2 class="mb-2">Plateforme de notation des établissements</h2>
                    <p class="mb-0">Université d'Antsiranana, Madagascar</p>
                </div>
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
