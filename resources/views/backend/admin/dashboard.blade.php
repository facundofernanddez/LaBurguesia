<x-layout title="Dashboard Admin">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <h1 class="fw-bold text-white mb-2">Dashboard administrativo</h1>
                <p class="text-white-50 mb-0">Resumen del negocio y gestión de productos.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Usuarios</p>
                                <h2 class="fw-bold mb-0">{{ $usuarios }}</h2>
                            </div>
                            <div class="fs-1 text-primary">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Productos</p>
                                <h2 class="fw-bold mb-0">{{ $productos->count() }}</h2>
                            </div>
                            <div class="fs-1 text-success">
                                <i class="bi bi-box-seam"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Gestión de productos</h4>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <h5 class="mb-3">{{ $editingProducto ? 'Editar producto' : 'Crear producto' }}</h5>

                        <form
                            action="{{ $editingProducto ? route('admin.productos.update', $editingProducto) : route('admin.productos.store') }}"
                            method="POST">
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
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Imagen</label>
                                    <input type="text" name="imagen" class="form-control"
                                        value="{{ old('imagen', $editingProducto->imagen ?? '') }}"
                                        placeholder="ej: burger.png">
                                    @error('imagen')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                            value="1"
                                            {{ old('activo', $editingProducto?->activo ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="activo">Producto activo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ $editingProducto ? 'Actualizar producto' : 'Crear producto' }}
                                </button>
                                @if ($editingProducto)
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="btn btn-outline-secondary">Cancelar</a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-7">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Productos actuales</h5>
                            <span class="badge bg-secondary">{{ $productos->count() }}</span>
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

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Lista de usuarios</h4>
            </div>
            <div class="card-body">
                @if ($usuariosList->isEmpty())
                    <div class="alert alert-info mb-0">No hay usuarios registrados aún.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Registrado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuariosList as $usuario)
                                    <tr>
                                        <td>{{ $usuario->nombre }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            <form action="{{ route('admin.usuarios.updateRol', $usuario) }}"
                                                method="POST" class="d-flex gap-2 align-items-center mb-0">
                                                @csrf
                                                @method('PUT')
                                                <select name="rol" class="form-select form-select-sm">
                                                    <option value="cliente"
                                                        {{ $usuario->rol?->nombre === 'cliente' ? 'selected' : '' }}>
                                                        Cliente</option>
                                                    <option value="admin"
                                                        {{ $usuario->rol?->nombre === 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                </select>
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-primary">Guardar</button>
                                            </form>
                                        </td>
                                        <td>{{ $usuario->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Gestión de categorías</h4>
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
                            <span class="badge bg-secondary">{{ $categorias->count() }}</span>
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
    </div>
</x-layout>
