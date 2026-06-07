<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-marron text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Lista de usuarios</h4>
        <span class="badge bg-rojo">{{ $usuarios }} usuarios</span>
    </div>
    <div class="card-body">
        @if ($usuariosList->isEmpty())
            <div class="alert alert-info mb-0">No hay usuarios registrados aún.</div>
        @else
            <!-- Buscador de usuarios -->
            <div class="row mb-3">
                <div class="col-md-6 col-lg-4">
                    <x-search-input id="buscarUsuario" placeholder="Buscar por nombre o correo..." />
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tablaUsuarios">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Activo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaUsuarios">
                        @foreach ($usuariosList as $usuario)
                            <tr class="fila-usuario">
                                <td class="col-nombre">{{ $usuario->nombre }}</td>
                                <td class="col-email">{{ $usuario->email }}</td>
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
                        <!-- Fila de sin resultados -->
                        <tr id="sinResultadosUsuarios" style="display: none;">
                            <td colspan="5" class="text-center text-muted py-3">
                                No se encontraron usuarios que coincidan con la búsqueda.
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
        const inputBuscar = document.getElementById('buscarUsuario');
        const cuerpoTabla = document.getElementById('cuerpoTablaUsuarios');
        const filaSinResultados = document.getElementById('sinResultadosUsuarios');

        if (inputBuscar && cuerpoTabla) {
            const filas = cuerpoTabla.querySelectorAll('.fila-usuario');

            inputBuscar.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                let coincidencias = 0;

                filas.forEach(fila => {
                    const nombre = fila.querySelector('.col-nombre').textContent.toLowerCase();
                    const email = fila.querySelector('.col-email').textContent.toLowerCase();

                    if (nombre.includes(query) || email.includes(query)) {
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
