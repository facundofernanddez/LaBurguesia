<div class="card shadow-sm border-0">
    <div class="card-header bg-marron text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Gestión de productos</h4>
        <span class="badge bg-rojo">{{ $productos->count() }} productos</span>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-lg-5">
                <h5 class="mb-3">{{ $editingProducto ? 'Editar producto' : 'Crear producto' }}</h5>

                <form
                    action="{{ $editingProducto ? route('admin.productos.update', $editingProducto) : route('admin.productos.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($editingProducto)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $editingProducto->nombre ?? '') }}">
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $editingProducto->descripcion ?? '') }}</textarea>
                        @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Precio</label>
                            <input type="number" min="0" name="precio" class="form-control"
                                        value="{{ old('precio', $editingProducto->precio ?? 0) }}">
                            @error('precio')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Categoría</label>
                            @if (!empty($categoriaOptions) && count($categoriaOptions) > 0)
                                <select name="categoria" class="form-select">
                                    <option value="">Selecciona una categoría</option>
                                    @foreach ($categoriaOptions as $categoria)
                                        <option value="{{ $categoria }}"
                                            {{ old('categoria', $editingProducto->categoria ?? '') === $categoria ? 'selected' : '' }}>
                                            {{ ucfirst($categoria) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @else
                                <div class="alert alert-warning mb-0">No hay categorías. Crea una categoría en
                                             la sección de abajo para poder agregar productos.
                                    <a href="#categorias" class="btn btn-sm btn-secondary ms-2">Crear
                                                 categoría</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-4">
                            <label class="form-label d-block">Imagen</label>
                            <label for="imagen" id="imagen-label" class="btn btn-outline-secondary w-100 text-truncate" style="transition: all 0.3s ease;">
                                <i class="bi bi-cloud-upload me-2"></i>Seleccionar imagen
                            </label>
                            <input type="file" name="imagen" id="imagen" class="d-none" accept="image/*">
                            @if ($editingProducto && $editingProducto->imagen)
                                <div class="mt-1 text-muted small">
                                    Actual: <code>{{ $editingProducto->imagen }}</code>
                                </div>
                            @endif
                            @error('imagen')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stock</label>
                            <input type="number" min="0" name="stock" class="form-control"
                                        value="{{ old('stock', $editingProducto->stock ?? 0) }}">
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 d-flex flex-column justify-content-end pb-2">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                            value="1"
                                            {{ old('activo', $editingProducto?->activo ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="activo">Producto activo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="destacado" id="destacado"
                                            value="1"
                                            {{ old('destacado', $editingProducto?->destacado ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="destacado">Destacado ⭐</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        @if (!empty($categoriaOptions) && count($categoriaOptions) > 0)
                            <button type="submit" class="btn btn-primary">
                                {{ $editingProducto ? 'Actualizar producto' : 'Crear producto' }}
                            </button>
                            @if ($editingProducto)
                                <a href="{{ route('admin.dashboard') }}"
                                             class="btn btn-outline-secondary">Cancelar</a>
                            @endif
                        @else
                            <a href="#categorias" class="btn btn-secondary">Crear categoría primero</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Productos actuales</h5>
                </div>

                @if ($productos->isEmpty())
                    <div class="alert alert-info mb-0">Todavía no hay productos cargados.</div>
                @else
                    <!-- Buscador de productos -->
                    <x-search-input id="buscarProducto" placeholder="Buscar por nombre o categoría..." />

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="tablaProductos">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Destacado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cuerpoTablaProductos">
                                @foreach ($productos as $producto)
                                    <tr class="fila-producto">
                                        <td class="col-nombre">{{ $producto->nombre }}</td>
                                        <td class="col-categoria">{{ ucfirst($producto->categoria) }}</td>
                                        <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $producto->stock > 0 ? 'bg-info' : 'bg-danger' }}">
                                                {{ $producto->stock }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                          class="badge {{ $producto->activo ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.productos.updateDestacado', $producto) }}" method="POST" class="mb-0">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent text-decoration-none" title="Cambiar destacado">
                                                    @if ($producto->destacado)
                                                        <span class="badge bg-warning text-dark" style="cursor: pointer;">
                                                            <i class="bi bi-star-fill text-dark me-1"></i>Sí
                                                        </span>
                                                    @else
                                                        <span class="badge bg-light text-muted border" style="cursor: pointer;">
                                                            <i class="bi bi-star me-1"></i>No
                                                        </span>
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.dashboard', ['edit_producto' => $producto->id]) }}"
                                                             class="btn btn-sm btn-outline-primary">Editar</a>
                                                <form
                                                             action="{{ route('admin.productos.destroy', $producto) }}"
                                                             method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                                 class="btn btn-sm btn-outline-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Fila de sin resultados -->
                                <tr id="sinResultadosProductos" style="display: none;">
                                    <td colspan="7" class="text-center text-muted py-3">
                                        No se encontraron productos que coincidan con la búsqueda.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script para label de imagen
        const imagenInput = document.getElementById('imagen');
        const imagenLabel = document.getElementById('imagen-label');

        if (imagenInput && imagenLabel) {
            const originalHTML = imagenLabel.innerHTML;

            imagenInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    const fileName = this.files[0].name;
                    imagenLabel.innerHTML = `<i class="bi bi-check-circle-fill me-2"></i> ${fileName}`;
                    imagenLabel.classList.remove('btn-outline-secondary');
                    imagenLabel.classList.add('btn-success', 'text-white');
                } else {
                    imagenLabel.innerHTML = originalHTML;
                    imagenLabel.classList.remove('btn-success', 'text-white');
                    imagenLabel.classList.add('btn-outline-secondary');
                }
            });
        }

        // Script para buscador dinámico
        const inputBuscar = document.getElementById('buscarProducto');
        const cuerpoTabla = document.getElementById('cuerpoTablaProductos');
        const filaSinResultados = document.getElementById('sinResultadosProductos');

        if (inputBuscar && cuerpoTabla) {
            const filas = cuerpoTabla.querySelectorAll('.fila-producto');

            inputBuscar.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                let coincidencias = 0;

                filas.forEach(fila => {
                    const nombre = fila.querySelector('.col-nombre').textContent.toLowerCase();
                    const categoria = fila.querySelector('.col-categoria').textContent.toLowerCase();

                    if (nombre.includes(query) || categoria.includes(query)) {
                        fila.style.display = '';
                        coincidencias++;
                    } else {
                        fila.style.display = 'none';
                    }
                });

                if (coincidencias === 0) {
                    filaSinResultados.style.display = '';
                } else {
                    filaSinResultados.style.display = 'none';
                }
            });
        }
    });
</script>
