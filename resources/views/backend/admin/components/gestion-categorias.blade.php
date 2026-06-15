<div class="card shadow-sm border-0 mt-4" id="categorias">
    <div class="card-header bg-marron text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Gestión de categorías</h4>
        <span class="badge bg-rojo">{{ $categorias->count() }} categorías</span>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-lg-5">
                <h5 class="mb-3">{{ $editingCategoria ? 'Editar categoría' : 'Crear categoría' }}</h5>
                <form
                    action="{{ $editingCategoria ? route('admin.categorias.update', $editingCategoria) : route('admin.categorias.store') }}"
                    method="POST" id="formCategoria" class="needs-validation" novalidate>
                    @csrf
                    @if ($editingCategoria)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $editingCategoria->nombre ?? '') }}" required>
                        <div class="invalid-feedback">El nombre de la categoría es obligatorio.</div>
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $editingCategoria->descripcion ?? '') }}</textarea>
                        @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="activo" id="activo_categoria"
                            value="1"
                            {{ old('activo', $editingCategoria?->activo ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="activo_categoria">Categoría activa</label>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ $editingCategoria ? 'Actualizar categoría' : 'Crear categoría' }}
                        </button>
                        @if ($editingCategoria)
                            <a href="{{ route('admin.dashboard') }}"
                                        class="btn btn-outline-secondary">Cancelar</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Categorías</h5>
                </div>

                @if ($categorias->isEmpty())
                    <div class="alert alert-info mb-0">No hay categorías registradas aún.</div>
                @else
                    <!-- Buscador de categorías -->
                    <x-search-input id="buscarCategoria" placeholder="Buscar por nombre o descripción..." />

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 table-sm" id="tablaCategorias" style="font-size: 0.85rem;">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cuerpoTablaCategorias">
                                @foreach ($categorias as $categoria)
                                    <tr class="fila-categoria">
                                        <td class="col-nombre">{{ ucfirst($categoria->nombre) }}</td>
                                        <td class="col-descripcion">{{ $categoria->descripcion }}</td>
                                        <td>
                                            <span class="badge {{ $categoria->activo ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $categoria->activo ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('admin.dashboard', ['edit_categoria' => $categoria->id]) }}"
                                                                class="btn btn-sm btn-outline-primary" title="Editar">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form
                                                                action="{{ route('admin.categorias.destroy', $categoria) }}"
                                                                method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                                class="btn btn-sm {{ $categoria->activo ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                                title="{{ $categoria->activo ? 'Desactivar' : 'Activar' }}">
                                                        <i class="bi {{ $categoria->activo ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-6"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Fila de sin resultados -->
                                <tr id="sinResultadosCategorias" style="display: none;">
                                    <td colspan="4" class="text-center text-muted py-3">
                                        No se encontraron categorías que coincidan con la búsqueda.
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
        const inputBuscar = document.getElementById('buscarCategoria');
        const cuerpoTabla = document.getElementById('cuerpoTablaCategorias');
        const filaSinResultados = document.getElementById('sinResultadosCategorias');

        if (inputBuscar && cuerpoTabla) {
            const filas = cuerpoTabla.querySelectorAll('.fila-categoria');

            inputBuscar.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                let coincidencias = 0;

                filas.forEach(fila => {
                    const nombre = fila.querySelector('.col-nombre').textContent.toLowerCase();
                    const descripcion = fila.querySelector('.col-descripcion').textContent.toLowerCase();

                    if (nombre.includes(query) || descripcion.includes(query)) {
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
