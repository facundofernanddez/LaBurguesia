<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('img/logo.png') }}" alt="La Burguesia" class="me-2">
        </a>

        <div class="d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Carrito siempre visible en móvil -->
            @if (Auth::user()?->rol?->nombre !== 'admin')
                <a class="nav-link d-lg-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart">
                    <i class="bi bi-cart"></i>
                </a>
            @endif
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="/quienessomos">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="/catalogo">Menú</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="/comercializacion">Comercialización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="/contacto">Contacto</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/login">Ingresar</a>
                    </li>
                @else
                    @if (Auth::user()?->rol?->nombre === 'admin')
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('admin.dashboard') }}">Panel Administrativo</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{ route('perfil') }}">Mi Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{ route('logout') }}">Salir</a>
                    </li>
                @endguest
                @if (Auth::user()?->rol?->nombre !== 'admin')
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart">
                            <i class="bi bi-cart"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
