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
                        <div class="col-md-4 d-flex align-items-end justify-content-center pb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                            value="1"
                                            {{ old('activo', $editingProducto?->activo ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="activo">Producto activo</label>
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
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ ucfirst($producto->categoria) }}</td>
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
    });
</script>
