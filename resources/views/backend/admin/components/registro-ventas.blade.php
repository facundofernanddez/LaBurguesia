<!-- Registro de Ventas -->
<div class="card shadow-sm border-0 mt-4" id="ventas">
    <div class="card-header bg-marron text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Registro de ventas</h4>
        <span class="badge bg-rojo">{{ $ventas->count() }} ventas</span>
    </div>
    <div class="card-body">
        <!-- Filtros -->
        <form method="GET" action="{{ route('admin.dashboard') }}#ventas" class="row g-3 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Filtrar por Usuario</label>
                <select name="filtrar_usuario" class="form-select">
                    <option value="">Todos los usuarios</option>
                    @foreach ($usuariosList as $u)
                        <option value="{{ $u->id }}" {{ request('filtrar_usuario') == $u->id ? 'selected' : '' }}>
                            {{ $u->nombre }} ({{ $u->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Filtrar por Producto</label>
                <select name="filtrar_producto" class="form-select">
                    <option value="">Todos los productos</option>
                    @foreach ($productos as $p)
                        <option value="{{ $p->id }}" {{ request('filtrar_producto') == $p->id ? 'selected' : '' }}>
                            {{ $p->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Fecha Desde</label>
                <input type="date" name="filtrar_fecha_desde" class="form-control" value="{{ request('filtrar_fecha_desde') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Fecha Hasta</label>
                <input type="date" name="filtrar_fecha_hasta" class="form-control" value="{{ request('filtrar_fecha_hasta') }}">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel-fill me-1"></i>Filtrar
                </button>
                @if (request()->hasAny(['filtrar_usuario', 'filtrar_producto', 'filtrar_fecha_desde', 'filtrar_fecha_hasta']))
                    <a href="{{ route('admin.dashboard') }}#ventas" class="btn btn-outline-secondary" title="Limpiar filtros">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>

        @if ($ventas->isEmpty())
            <div class="alert alert-info mb-0">No se encontraron ventas con los filtros seleccionados.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos Vendidos</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td class="text-nowrap text-muted font-monospace">
                                    {{ $venta->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $venta->usuario?->nombre }}</div>
                                    <small class="text-muted">{{ $venta->usuario?->email }}</small>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($venta->detalles as $detalle)
                                            <li class="mb-1">
                                                <span class="badge bg-secondary me-1">{{ $detalle->cantidad }}x</span>
                                                {{ $detalle->producto?->nombre ?? 'Producto Eliminado' }}
                                                <small class="text-muted">(${{ number_format($detalle->precio_unitario, 0, ',', '.') }} c/u)</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-end fw-bold text-success fs-5">
                                    ${{ number_format($venta->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
