<nav class="navbar navbar-expand-md navbar-dark bg-dark p-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        @auth
            @if (Auth::user()->hasRole('Admin'))
                <div class="navbar-brand dropdown position-relative">
                    <a id="adminDropdownBtn" class="nav-link {{ request()->is('etablissements/create') || request()->is('mentions/create') || request()->is('register') ? 'active' : '' }}" href="#" role="button">
                        {{ __('Admin') }}
                    </a>

                    <div id="adminDropdownMenu" class="dropdown-menu position-absolute shadow-lg p-3 bg-white rounded"
                        style="display: none; top: 100%; left: 0; z-index: 1050; min-width: 200px;">
                        <a class="dropdown-item" href="{{ route('etablissements.create') }}">Ajouter Établissement</a>
                        <a class="dropdown-item" href="{{ route('mentions.create') }}">Ajouter Mention</a>
                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Ajouter un étudiant') }}</a>
                    </div>
                </div>
            @endif

            <a class="navbar-brand nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                {{ __('Tableau de bord') }}
            </a>
        @endauth

        <a class="navbar-brand nav-link {{ request()->routeIs('classement.public') ? 'active' : '' }}" href="{{ route('classement.public') }}">
            {{ __('Classement') }}
        </a>

        <a class="navbar-brand nav-link {{ request()->routeIs('temoignages.index') ? 'active' : '' }}" href="{{ route('temoignages.index') }}">
            {{ __('Avis et témoignage') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto"></ul>
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
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::user()->profil)
                                <img src="{{ asset('storage/' . Auth::user()->profil) }}" alt="Profil"
                                    class="rounded-circle me-2" width="30" height="30">
                            @else
                                <i class="bi bi-person-circle fs-4 me-2"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('etudiant.espace') }}">
                                <i class="bi bi-person-circle me-2"></i> {{ __('Espace Etudiant') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('password.change') }}">
                                <i class="bi bi-shield-lock me-2"></i>Changer mot de passe
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('adminDropdownBtn');
        const menu = document.getElementById('adminDropdownMenu');

        if (btn && menu) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
            });

            document.addEventListener('click', function (e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.style.display = 'none';
                }
            });
        }
    });
</script>
