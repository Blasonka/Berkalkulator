    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 rounded-bottom">
            <div class="container-fluid">
                <a class="navbar-brand ps-5 ms-5" href="{{ route('home') }}">Bérkalkulátor</a>
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
                            <a class="nav-link {{ request()->is('thanks') ? 'active' : '' }}"
                                href="{{ route('thanks') }}">Köszönet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('support') ? 'active' : '' }}"
                                href="{{ route('support') }}">Kapcsolat</a>
                        </li>
                    </ul>

                    {{-- Navbar right side --}}
                    <ul class="navbar-nav ms-auto pe-5 me-5">

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
                            <li class="nav-item {{ request()->is('calculator') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('calculator') }}">Kalkulátor</a>
                            </li>

                            <div class="dropdown nav-item">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu bg-dark nav-item">
                                    <li><a class=" nav-link dropdown-item-custome dropdown-item {{ request()->is('shifts') ? 'active' : '' }}"
                                            href="{{ route('shifts') }}">Mentett beosztások</a></li>
                                    <li><a class="nav-link dropdown-item-custome dropdown-item {{ request()->is('profile') ? 'active' : '' }}"
                                            href="{{ route('profile') }}">Profil</a></li>
                                    <li><a class="nav-link dropdown-item-custome dropdown-item {{ request()->is('logout') ? 'active' : '' }}"
                                            href="{{ route('logout') }}">Kijelentkezés</a></li>
                                </ul>
                            </div>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    </div>
