<nav class="navbar navbar-expand-md navbar-dark text-white bg-success bg-opacity-75 p-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Gauche --}}
            <ul class="navbar-nav me-auto">
                @auth
                    @if (Auth::user()->hasRole('Admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('etablissements/create') || request()->is('mentions/create') || request()->is('register') ? 'active' : '' }}"
                               href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="{{ route('etablissements.create') }}">Ajouter Établissement</a></li>
                                <li><a class="dropdown-item" href="{{ route('mentions.create') }}">Ajouter Mention</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Ajouter un étudiant</a></li>
                                <li><a class="dropdown-item" href="">Ajouter taux de réussite</a></li>
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            {{ __('Tableau de bord') }}
                        </a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('classement.public') ? 'active' : '' }}" href="{{ route('classement.public') }}">
                        {{ __('Classement') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('temoignages.index') ? 'active' : '' }}" href="{{ route('temoignages.index') }}">
                        {{ __('Avis et témoignage') }}
                    </a>
                </li>
            </ul>

            {{-- Droite --}}
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->profil)
                                <img src="{{ asset('storage/' . Auth::user()->profil) }}" alt="Profil"
                                    class="rounded-circle me-2" width="30" height="30">
                            @else
                                <i class="bi bi-person-circle fs-4 me-2"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('etudiant.espace') }}"><i class="bi bi-person-circle me-2"></i> Espace Etudiant</a></li>
                            <li><a class="dropdown-item" href="{{ route('password.change') }}"><i class="bi bi-shield-lock me-2"></i>Changer mot de passe</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> {{ __('Déconnexion') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
