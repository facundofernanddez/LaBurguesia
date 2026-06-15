<!-- Registro de Ventas -->
<style>
    #cuerpoTablaVentas .accordion-button:not(.collapsed) {
        background-color: #f0e9dd !important;
        color: #502314 !important;
        box-shadow: none !important;
    }
    #cuerpoTablaVentas .accordion-button:focus {
        box-shadow: none !important;
        border-color: rgba(80, 35, 20, 0.1) !important;
    }
    #cuerpoTablaVentas .border-bottom-dashed {
        border-bottom: 1px dashed #dee2e6;
    }
    #cuerpoTablaVentas .border-bottom-dashed:last-child {
        border-bottom: none;
    }
</style>

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
            <div class="accordion" id="cuerpoTablaVentas">
                @foreach ($ventas as $venta)
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden fila-venta"
                         data-id="{{ $venta->id }}" 
                         data-usuario-id="{{ $venta->usuario_id }}" 
                         data-fecha="{{ $venta->created_at->format('Y-m-d') }}" 
                         data-productos="{{ implode(',', $venta->detalles->pluck('producto_id')->filter()->toArray()) }}">
                        <h2 class="accordion-header" id="heading-{{ $venta->id }}">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $venta->id }}" aria-expanded="false" aria-controls="collapse-{{ $venta->id }}" style="background-color: #fcfaf6; color: #502314;">
                                <div class="d-flex justify-content-between align-items-center w-100 pe-3 flex-wrap gap-3">
                                    <div>
                                        <span class="text-muted small d-block">Venta #{{ $venta->id }}</span>
                                        <span class="font-monospace text-muted" style="font-size: 13px;">{{ $venta->created_at->format('d/m/Y H:i') }} hs</span>
                                    </div>
                                    <div class="flex-grow-1 ms-lg-4 text-start">
                                        <span class="d-block fw-bold text-dark">{{ $venta->usuario?->nombre }}</span>
                                        <span class="text-muted small">{{ $venta->usuario?->email }}</span>
                                    </div>
                                    <div class="text-end">
                                        <span class="fs-5 fw-bold text-success">${{ number_format($venta->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse-{{ $venta->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $venta->id }}" data-bs-parent="#cuerpoTablaVentas">
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
                                            @foreach ($venta->detalles as $detalle)
                                                <tr class="border-bottom-dashed">
                                                    <td>
                                                        <img src="{{ asset($detalle->producto?->imagen ? 'img/producto/' . $detalle->producto->imagen : 'img/logo.png') }}" alt="{{ $detalle->producto?->nombre ?? 'Producto' }}" class="img-fluid rounded-3" style="max-height: 50px; width: 50px; object-fit: cover;">
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold text-dark">{{ $detalle->producto?->nombre ?? 'Producto de baja' }}</span>
                                                    </td>
                                                    <td class="text-center">{{ $detalle->cantidad }}</td>
                                                    <td class="text-end">${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                                                    <td class="text-end fw-semibold text-dark">${{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Checkout Info -->
                                <div class="mt-3 pt-3 border-top d-flex flex-wrap gap-4 text-muted small">
                                    <div>
                                        <i class="bi bi-truck me-1"></i><strong>Entrega:</strong> 
                                        {{ $venta->metodo_entrega === 'delivery' ? 'Envío a domicilio' : 'Retiro en local (Take Away)' }}
                                    </div>
                                    @if($venta->metodo_entrega === 'delivery')
                                        <div>
                                            <i class="bi bi-geo-alt me-1"></i><strong>Dirección:</strong> {{ $venta->direccion }}
                                        </div>
                                        <div>
                                            <i class="bi bi-cash me-1"></i><strong>Costo Envío:</strong> ${{ number_format($venta->costo_envio, 0, ',', '.') }}
                                        </div>
                                    @endif
                                    <div>
                                        <i class="bi bi-wallet2 me-1"></i><strong>Forma de Pago:</strong> 
                                        {{ $venta->forma_pago === 'efectivo' ? 'Efectivo' : ($venta->forma_pago === 'tarjeta' ? 'Tarjeta' : 'Transferencia') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Div de sin resultados para JS -->
            <div id="sinResultadosVentas" class="alert alert-warning text-center mt-3" style="display: none;">
                No se encontraron ventas que coincidan con los filtros.
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
