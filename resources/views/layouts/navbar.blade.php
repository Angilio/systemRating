<nav class="navbar navbar-expand-md navbar-dakr">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @auth
                    @role('Admin')
                        <div class="navbar-brand dropdown position-relative">
                            <a id="adminDropdownBtn" class="nav-link" href="#" role="button">
                                {{ __('Admin') }}
                            </a>

                            <div id="adminDropdownMenu" class="dropdown-menu position-absolute shadow-lg p-3 bg-white rounded" style="display: none; top: 100%; left: 0; z-index: 1050; min-width: 200px;">
                                <a class="dropdown-item" href="{{ route('etablissements.create') }}">Ajouter Établissement</a>
                                <a class="dropdown-item" href="{{ route('mentions.create') }}">Ajouter Mention</a>
                                <!-- Autres liens admin -->
                            </div>
                        </div>
                    @endrole
                @endauth
                <a class="navbar-brand" href="">
                    {{ __('Système de notation') }}
                </a>
                <a class="navbar-brand" href="">
                    {{ __('Tableau de bord') }}
                </a>
                <a class="navbar-brand" href="">
                    {{ __('Etudiants') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
                });

                // Fermer le menu si on clique ailleurs
                document.addEventListener('click', function (e) {
                    if (!btn.contains(e.target) && !menu.contains(e.target)) {
                        menu.style.display = 'none';
                    }
                });
            });
        </script>