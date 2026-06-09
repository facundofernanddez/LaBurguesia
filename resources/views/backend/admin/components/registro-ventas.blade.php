<!-- Registro de Ventas -->
<div class="card shadow-sm border-0 mt-4" id="ventas">
    <div class="card-header bg-marron text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Registro de ventas</h4>
        <span class="badge bg-rojo">{{ $ventas->count() }} ventas</span>
    </div>
    <div class="card-body">
        <!-- Filtros -->
        <form id="formFiltrosVentas" class="row g-3 mb-4 align-items-end">
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">ID de Venta</label>
                <input type="number" id="filtrar_id" class="form-control" placeholder="Ej: 15">
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Filtrar por Usuario</label>
                <select id="filtrar_usuario" class="form-select">
                    <option value="">Todos los usuarios</option>
                    @foreach ($usuariosList as $u)
                        <option value="{{ $u->id }}">
                            {{ $u->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Filtrar por Producto</label>
                <select id="filtrar_producto" class="form-select">
                    <option value="">Todos los productos</option>
                    @foreach ($productos as $p)
                        <option value="{{ $p->id }}">
                            {{ $p->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Fecha Desde</label>
                <input type="date" id="filtrar_fecha_desde" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Fecha Hasta</label>
                <input type="date" id="filtrar_fecha_hasta" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="button" id="btnLimpiarFiltros" class="btn btn-outline-secondary w-100" title="Limpiar filtros" style="display: none;">
                    <i class="bi bi-x-lg me-1"></i>Limpiar
                </button>
            </div>
        </form>

        @if ($ventas->isEmpty())
            <div class="alert alert-info mb-0">No se encontraron ventas registradas en el sistema.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos Vendidos</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaVentas">
                        @foreach ($ventas as $venta)
                            <tr class="fila-venta" 
                                data-id="{{ $venta->id }}" 
                                data-usuario-id="{{ $venta->usuario_id }}" 
                                data-fecha="{{ $venta->created_at->format('Y-m-d') }}" 
                                data-productos="{{ implode(',', $venta->detalles->pluck('producto_id')->filter()->toArray()) }}">
                                <td class="fw-bold">#{{ $venta->id }}</td>
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
                        <!-- Fila de sin resultados -->
                        <tr id="sinResultadosVentas" style="display: none;">
                            <td colspan="5" class="text-center text-muted py-3">
                                No se encontraron ventas que coincidan con los filtros.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputId = document.getElementById('filtrar_id');
        const selectUsuario = document.getElementById('filtrar_usuario');
        const selectProducto = document.getElementById('filtrar_producto');
        const inputFechaDesde = document.getElementById('filtrar_fecha_desde');
        const inputFechaHasta = document.getElementById('filtrar_fecha_hasta');
        const btnLimpiar = document.getElementById('btnLimpiarFiltros');
        
        const cuerpoTabla = document.getElementById('cuerpoTablaVentas');
        const filaSinResultados = document.getElementById('sinResultadosVentas');
        
        if (cuerpoTabla) {
            const filas = cuerpoTabla.querySelectorAll('.fila-venta');
            
            function filtrarVentas() {
                const valId = inputId ? inputId.value.trim() : '';
                const valUsuario = selectUsuario ? selectUsuario.value : '';
                const valProducto = selectProducto ? selectProducto.value : '';
                const valDesde = inputFechaDesde ? inputFechaDesde.value : '';
                const valHasta = inputFechaHasta ? inputFechaHasta.value : '';
                
                let coincidencias = 0;
                
                filas.forEach(fila => {
                    const id = fila.dataset.id;
                    const usuarioId = fila.dataset.usuarioId;
                    const fecha = fila.dataset.fecha;
                    const productos = fila.dataset.productos.split(',');
                    
                    let mostrar = true;
                    
                    if (valId && !id.includes(valId)) {
                        mostrar = false;
                    }
                    if (valUsuario && usuarioId !== valUsuario) {
                        mostrar = false;
                    }
                    if (valProducto && !productos.includes(valProducto)) {
                        mostrar = false;
                    }
                    if (valDesde && fecha < valDesde) {
                        mostrar = false;
                    }
                    if (valHasta && fecha > valHasta) {
                        mostrar = false;
                    }
                    
                    if (mostrar) {
                        fila.style.display = '';
                        coincidencias++;
                    } else {
                        fila.style.display = 'none';
                    }
                });
                
                if (coincidencias === 0) {
                    if (filaSinResultados) filaSinResultados.style.display = '';
                } else {
                    if (filaSinResultados) filaSinResultados.style.display = 'none';
                }
                
                // Mostrar/ocultar el botón limpiar
                if (btnLimpiar) {
                    const tieneFiltros = valId || valUsuario || valProducto || valDesde || valHasta;
                    btnLimpiar.style.display = tieneFiltros ? 'inline-block' : 'none';
                }
            }
            
            // Vincular listeners
            if (inputId) inputId.addEventListener('input', filtrarVentas);
            if (selectUsuario) selectUsuario.addEventListener('change', filtrarVentas);
            if (selectProducto) selectProducto.addEventListener('change', filtrarVentas);
            if (inputFechaDesde) inputFechaDesde.addEventListener('input', filtrarVentas);
            if (inputFechaDesde) inputFechaDesde.addEventListener('change', filtrarVentas);
            if (inputFechaHasta) inputFechaHasta.addEventListener('input', filtrarVentas);
            if (inputFechaHasta) inputFechaHasta.addEventListener('change', filtrarVentas);
            
            // Botón Limpiar
            if (btnLimpiar) {
                btnLimpiar.addEventListener('click', function() {
                    if (inputId) inputId.value = '';
                    if (selectUsuario) selectUsuario.value = '';
                    if (selectProducto) selectProducto.value = '';
                    if (inputFechaDesde) inputFechaDesde.value = '';
                    if (inputFechaHasta) inputFechaHasta.value = '';
                    filtrarVentas();
                });
            }
            
            // Evitar envío del form
            const form = document.getElementById('formFiltrosVentas');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                });
            }
        }
    });
</script>
    </div>
</div>
