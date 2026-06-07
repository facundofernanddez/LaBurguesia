<!-- Sección de consultas de contacto -->
<div class="card shadow-sm border-0 mt-4 mb-5" id="consultas">
    <div class="card-header bg-marron text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Consultas de contacto</h4>
        <span class="badge bg-rojo">{{ $contactos->count() }} consultas</span>
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
