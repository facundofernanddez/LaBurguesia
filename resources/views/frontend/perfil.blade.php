<x-layout title="Mi Perfil">
    <div class="row pt-4">
        <!-- Columna Datos del Usuario -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm rounded-4" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(8px);">
                <div class="card-header bg-marron text-white rounded-top-4 py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-white"><i class="bi bi-person-circle me-2"></i>Mis Datos</h4>
                    @if ($usuario->rol?->nombre === 'admin')
                        <span class="badge bg-warning text-dark fw-bold"><i class="bi bi-shield-lock-fill me-1"></i>Administrador</span>
                    @else
                        <span class="badge bg-secondary text-white fw-bold"><i class="bi bi-person-fill me-1"></i>Cliente</span>
                    @endif
                </div>
                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('perfil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #502314;">Nombre completo</label>
                            <input type="text" name="nombre" class="form-control rounded-3" value="{{ old('nombre', $usuario->nombre) }}">
                            @error('nombre')
                                <small class="text-danger"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #502314;">Correo electrónico</label>
                            <input type="email" name="email" class="form-control rounded-3" value="{{ old('email', $usuario->email) }}">
                            @error('email')
                                <small class="text-danger"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                            @enderror
                        </div>

                        <hr class="my-4 text-muted">
                        <h5 class="fw-bold mb-3" style="color: #502314;"><i class="bi bi-key-fill me-2"></i>Cambiar contraseña</h5>
                        <p class="text-muted small mb-3">Dejar en blanco si no deseas modificarla.</p>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #502314;">Nueva contraseña</label>
                            <input type="password" name="password" class="form-control rounded-3" placeholder="Mínimo 6 caracteres">
                            @error('password')
                                <small class="text-danger"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #502314;">Confirmar nueva contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-3" placeholder="Repite la contraseña">
                        </div>

                        <button type="submit" class="btn text-white w-100 mt-3 py-2 fw-semibold shadow-sm btn-submit" style="background-color: #D62300; border-radius: 20px; transition: all 0.3s ease;">
                            Guardar Cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Historial de Compras -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm rounded-4" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(8px);">
                <div class="card-header bg-marron text-white rounded-top-4 py-3">
                    <h4 class="mb-0 text-white"><i class="bi bi-bag-check-fill me-2"></i>Mis Compras</h4>
                </div>
                <div class="card-body p-4">
                    @if ($compras->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x text-muted" style="font-size: 3.5rem;"></i>
                            <h5 class="fw-bold mt-3" style="color: #502314;">Aún no realizaste ninguna compra</h5>
                            <p class="text-muted font-medium">¡Date un gusto y prueba las hamburguesas más sabrosas de la ciudad!</p>
                            <a href="/catalogo" class="btn text-white mt-2 px-4 py-2 fw-semibold shadow-sm" style="background-color: #D62300; border-radius: 20px;">
                                Ver Menú
                            </a>
                        </div>
                    @else
                        <div class="accordion" id="accordionCompras">
                            @foreach ($compras as $index => $compra)
                                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                                    <h2 class="accordion-header" id="heading-{{ $compra->id }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $compra->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $compra->id }}" style="background-color: #fcfaf6; color: #502314;">
                                            <div class="d-flex justify-content-between w-100 pe-3 flex-wrap gap-2">
                                                <div>
                                                    <span class="text-muted small d-block">Compra #{{ $compra->id }}</span>
                                                    <span>{{ $compra->created_at->format('d/m/Y H:i') }} hs</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <span class="fs-5 fw-bold text-danger">${{ number_format($compra->total, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $compra->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $compra->id }}" data-bs-parent="#accordionCompras">
                                        <div class="accordion-body bg-white p-3">
                                            <div class="table-responsive">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead>
                                                        <tr class="border-bottom text-muted small">
                                                            <th scope="col" style="width: 70px;">Item</th>
                                                            <th scope="col">Producto</th>
                                                            <th scope="col" class="text-center">Cant.</th>
                                                            <th scope="col" class="text-end">Precio</th>
                                                            <th scope="col" class="text-end">Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($compra->detalles as $detalle)
                                                            <tr class="border-bottom-dashed">
                                                                <td>
                                                                    <img src="{{ asset($detalle->producto?->imagen ? 'img/' . $detalle->producto->imagen : 'img/logo.png') }}" alt="{{ $detalle->producto?->nombre ?? 'Producto' }}" class="img-fluid rounded-3" style="max-height: 50px; width: 50px; object-fit: cover;">
                                                                </td>
                                                                <td>
                                                                    <span class="fw-semibold text-dark">{{ $detalle->producto?->nombre ?? 'Producto eliminado' }}</span>
                                                                </td>
                                                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                                                <td class="text-end">${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                                                                <td class="text-end fw-semibold text-dark">${{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-marron {
            background-color: #502314 !important;
        }
        .accordion-button:not(.collapsed) {
            background-color: #f0e9dd !important;
            color: #502314 !important;
            box-shadow: none !important;
        }
        .accordion-button:focus {
            box-shadow: none !important;
            border-color: rgba(80, 35, 20, 0.1) !important;
        }
        .border-bottom-dashed {
            border-bottom: 1px dashed #dee2e6;
        }
        .border-bottom-dashed:last-child {
            border-bottom: none;
        }
        .btn-submit:hover {
            background-color: #a91b00 !important;
        }
    </style>
</x-layout>
