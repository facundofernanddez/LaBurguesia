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
                    method="POST">
                    @csrf
                    @if ($editingCategoria)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ old('nombre', $editingCategoria->nombre ?? '') }}">
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
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                    <tr>
                                        <td>{{ ucfirst($categoria->nombre) }}</td>
                                        <td>{{ $categoria->descripcion }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.dashboard', ['edit_categoria' => $categoria->id]) }}"
                                                                class="btn btn-sm btn-outline-primary">Editar</a>
                                                <form
                                                                action="{{ route('admin.categorias.destroy', $categoria) }}"
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
