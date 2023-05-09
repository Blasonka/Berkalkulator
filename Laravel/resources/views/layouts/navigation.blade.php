    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 rounded-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Bérkalkulátor</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    {{-- Navbar laft side --}}
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                href="{{ route('home') }}">Főoldal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('') ? 'active' : '' }}" href="/">Köszönet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('support') ? 'active' : '' }}"
                                href="{{ route('support') }}">Kapcsolat</a>
                        </li>
                    </ul>

                    {{-- Navbar right side --}}
                    <ul class="navbar-nav ms-auto">
                        {{-- Only visibal for non authenticated visitors --}}
                        @guest
                            <li class="nav-item {{ request()->is('register') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('register') }}">Regisztráció</a>
                            </li>

                            <li class="nav-item {{ request()->is('login') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('login') }}">Belépés</a>
                            </li>
                        @endguest

                        {{-- Only visibal for authenticated visitors --}}
                        @auth
                            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">{{ Auth::user()->name }}</a>
                            </li>

                            <li class="nav-item {{ request()->is('logout') ? 'active' : '' }}">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link" href="{{ route('logout') }}" style="ded">Kijelentkezés</button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    </div>
