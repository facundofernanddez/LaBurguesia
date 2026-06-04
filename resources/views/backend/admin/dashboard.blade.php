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
                                    <th>Activo</th>
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
                                        <td>
                                            <form action="{{ route('admin.usuarios.updateActivo', $usuario) }}" method="POST" class="d-flex align-items-center gap-2 mb-0">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="activo" value="0">
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo-{{ $usuario->id }}" {{ $usuario->activo ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="activo-{{ $usuario->id }}">{{ $usuario->activo ? 'Activo' : 'Inactivo' }}</label>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Guardar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4" id="categorias">
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
        <!-- Registro de Ventas -->
        <div class="card shadow-sm border-0 mt-4" id="ventas">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Registro de ventas</h4>
                <span class="badge bg-primary">{{ $ventas->count() }} ventas</span>
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

        <!-- Sección de consultas de contacto -->
        <div class="card shadow-sm border-0 mt-4 mb-5" id="consultas">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Consultas de contacto</h4>
            </div>
            <div class="card-body">
                @if ($contactos->isEmpty())
                    <div class="alert alert-info mb-0">No hay consultas registradas aún.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Motivo</th>
                                    <th>Mensaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactos as $contacto)
                                    <tr>
                                        <td class="text-nowrap text-muted">{{ $contacto->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="fw-bold">{{ $contacto->nombre }}</td>
                                        <td><a href="mailto:{{ $contacto->email }}" class="text-decoration-none">{{ $contacto->email }}</a></td>
                                        <td><span class="badge bg-secondary">{{ $contacto->motivo }}</span></td>
                                        <td style="max-width: 350px; word-wrap: break-word; white-space: normal;">{{ $contacto->mensaje }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
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
</x-layout>
