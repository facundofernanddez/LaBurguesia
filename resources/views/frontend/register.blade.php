<x-layout title="Crear Cuenta">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card-register shadow-lg">
                    <div class="card-header-register text-center">
                        <img src="{{ asset('img/logo.png') }}" alt="La Burguesía" class="mb-3" style="height: 80px;">
                        <h2 class="fw-bold text-white mb-1">¡Crear Cuenta!</h2>
                        <p class="text-white-50 mb-0">Uniete a la familia burguesa</p>
                    </div>

                    <div class="card-body-register p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm mb-4">
                                <div class="fw-bold mb-2">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    No pudimos crear tu cuenta
                                </div>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nombre" class="form-label fw-semibold">
                                    <i class="bi bi-person-fill me-2"></i>Nombre completo
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-person text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Juan Pérez">
                                </div>
                                @error('nombre')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope-fill me-2"></i>Correo electrónico
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-envelope text-muted"></i>
                                    </span>
                                    <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="juan@ejemplo.com">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Nunca compartiremos tu correo con nadie.</div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock-fill me-2"></i>Contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-key text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••">
                                    <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                        <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Mínimo 8 caracteres.</div>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="bi bi-lock-fill me-2"></i>Confirmar contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-key text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="••••••••">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-registrar btn-lg fw-bold">
                                    <i class="bi bi-person-plus me-2"></i>Crear mi cuenta
                                </button>
                            </div>
                        </form>

                        <div class="text-center my-4">
                            <span class="bg-white px-3 position-relative" style="color: #999;">o</span>
                        </div>

                        <div class="text-center">
                            <p class="mb-0">¿Ya tenés cuenta?
                                <a href="/login" class="fw-bold text-decoration-none">
                                    Iniciá sesión
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-register {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: none;
        }

        .card-header-register {
            background: linear-gradient(135deg, #d62300 0%, #a91b00 100%);
            padding: 2rem 1rem;
        }

        .card-header-register h2 {
            font-size: 1.75rem;
        }

        .input-group-text {
            color: var(--rojo);
        }

        .form-control:focus {
            border-color: var(--rojo);
            box-shadow: 0 0 0 0.2rem rgba(214, 35, 0, 0.15);
        }

        .btn-registrar {
            background: linear-gradient(135deg, #d62300 0%, #a91b00 100%);
            color: white;
            border: none;
            padding: 0.875rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(214, 35, 0, 0.3);
        }

        .btn-registrar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(214, 35, 0, 0.4);
            background: linear-gradient(135deg, #b51e00 0%, #8a1600 100%);
        }

        .form-check-input:checked {
            background-color: var(--rojo);
            border-color: var(--rojo);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(214, 35, 0, 0.25);
        }
    </style>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            }
        });
    </script>
</x-layout>
