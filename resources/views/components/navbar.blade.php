<nav class="navbar navbar-expand-lg shadow-sm rounded" style="background: linear-gradient(135deg, #2c3e50, #4ca1af);">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-light" href="#">{{ $title }}</a>
        <button class="navbar-toggler text-light border-light" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    @auth
                        <a class="nav-link text-light" href="{{ route('map') }}">Peta</a>
                    @endauth
                    @guest
                        <a class="nav-link text-light disabled" style="cursor: not-allowed;"
                            title="Login terlebih dahulu">Peta</a>
                    @endguest
                </li>

                <li class="nav-item">
                    @auth
                        <a class="nav-link text-light" href="{{ route('table') }}">Tabel</a>
                    @endauth
                    @guest
                        <a class="nav-link text-light disabled" style="cursor: not-allowed;"
                            title="Login terlebih dahulu">Tabel</a>
                    @endguest
                </li>

                <li class="nav-item">
                    @auth
                        <a class="nav-link text-light" href="{{ route('analitik') }}">Analisis</a>
                    @endauth
                    @guest
                        <a class="nav-link text-light disabled" style="cursor: not-allowed;"
                            title="Login terlebih dahulu">Analisis</a>
                    @endguest
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Data GeoJSON
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('api.polygons') }}">Polygons</a></li>
                        <li><a class="dropdown-item" href="{{ route('api.polylines') }}">Polylines</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('api.points') }}">Points</a></li>
                    </ul>
                </li>
            </ul>

            @auth
                <li class="nav-item list-unstyled me-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li>
            @endauth

            @guest
                <li class="nav-item list-unstyled">
                    <a class="btn btn-outline-light" href="{{ route('login') }}">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </a>
                </li>
            @endguest
        </div>
    </div>
</nav>
