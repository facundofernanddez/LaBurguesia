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
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactos as $contacto)
                            <tr>
                                <td class="text-nowrap text-muted">{{ $contacto->created_at->format('d/m/Y H:i') }}</td>
                                <td class="fw-bold">{{ $contacto->nombre }}</td>
                                <td><a href="mailto:{{ $contacto->email }}" class="text-decoration-none">{{ $contacto->email }}</a></td>
                                <td><span class="badge bg-secondary">{{ $contacto->motivo }}</span></td>
                                <td style="max-width: 300px; word-wrap: break-word; white-space: normal;">{{ $contacto->mensaje }}</td>
                                <td>
                                    @if($contacto->respondido)
                                        <span class="badge bg-success">Respondida</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @endif
                                </td>
                                <td>
                                    @if($contacto->respondido)
                                        <button class="btn btn-sm btn-outline-info rounded-pill px-3" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#verRespuestaModal" 
                                            data-email="{{ $contacto->email }}" 
                                            data-mensaje="{{ $contacto->mensaje }}" 
                                            data-respuesta="{{ $contacto->respuesta }}">
                                            <i class="bi bi-eye-fill me-1"></i>Ver respuesta
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#responderModal" 
                                            data-email="{{ $contacto->email }}" 
                                            data-mensaje="{{ $contacto->mensaje }}" 
                                            data-action="{{ route('admin.consultas.responder', $contacto) }}">
                                            <i class="bi bi-reply-fill me-1"></i>Responder
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Modal de Responder Consulta -->
<div class="modal fade" id="responderModal" tabindex="-1" aria-labelledby="responderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow" style="background-color: #fcfaf6;">
            <div class="modal-header bg-marron text-white rounded-top-4 py-3">
                <h5 class="modal-title text-white" id="responderModalLabel">
                    <i class="bi bi-reply-fill me-2"></i>Responder Consulta
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formResponder" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <!-- Email Destinatario -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-marron">Destinatario</label>
                        <input type="text" class="form-control rounded-3 border-marron bg-light" id="modal-email" readonly style="color: #6c757d;">
                    </div>

                    <!-- Mensaje Original -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-marron">Mensaje Original</label>
                        <textarea class="form-control rounded-3 border-marron bg-light text-muted" id="modal-original" rows="3" readonly style="color: #6c757d;"></textarea>
                    </div>

                    <!-- Respuesta -->
                    <div class="mb-4">
                        <label for="modal-respuesta" class="form-label fw-bold text-marron">Tu Respuesta</label>
                        <textarea class="form-control rounded-3 border-marron" id="modal-respuesta" name="respuesta" rows="5" placeholder="Escribe tu respuesta aquí..." required minlength="5" maxlength="2000"></textarea>
                        <div class="invalid-feedback">
                            Por favor escribe una respuesta válida (mínimo 5 caracteres).
                        </div>
                    </div>

                    <button type="submit" class="btn text-white w-100 py-3 fw-bold rounded-pill shadow-sm btn-responder-submit" style="background-color: #D62300; transition: all 0.3s ease;">
                        Enviar Respuesta <i class="bi bi-send-fill ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Ver Respuesta Histórica -->
<div class="modal fade" id="verRespuestaModal" tabindex="-1" aria-labelledby="verRespuestaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow" style="background-color: #fcfaf6;">
            <div class="modal-header bg-marron text-white rounded-top-4 py-3">
                <h5 class="modal-title text-white" id="verRespuestaModalLabel">
                    <i class="bi bi-eye-fill me-2"></i>Detalle de Respuesta
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Email Destinatario -->
                <div class="mb-3">
                    <label class="form-label fw-bold text-marron">Destinatario</label>
                    <input type="text" class="form-control rounded-3 border-marron bg-light" id="ver-email" readonly style="color: #6c757d;">
                </div>

                <!-- Mensaje Original -->
                <div class="mb-3">
                    <label class="form-label fw-bold text-marron">Mensaje Original</label>
                    <textarea class="form-control rounded-3 border-marron bg-light text-muted" id="ver-original" rows="3" readonly style="color: #6c757d;"></textarea>
                </div>

                <!-- Respuesta Enviada -->
                <div class="mb-3">
                    <label class="form-label fw-bold text-marron">Respuesta Enviada</label>
                    <textarea class="form-control rounded-3 border-marron bg-light" id="ver-respuesta" rows="5" readonly style="color: #212529;"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-responder-submit:hover {
        background-color: #a91b00 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const responderModal = document.getElementById('responderModal');
        if (responderModal) {
            responderModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const email = button.getAttribute('data-email');
                const mensaje = button.getAttribute('data-mensaje');
                const action = button.getAttribute('data-action');
                
                responderModal.querySelector('#modal-email').value = email;
                responderModal.querySelector('#modal-original').value = mensaje;
                responderModal.querySelector('#formResponder').setAttribute('action', action);
                responderModal.querySelector('#modal-respuesta').value = '';
                
                // Limpiar validaciones previas
                responderModal.querySelector('#formResponder').classList.remove('was-validated');
            });
        }

        const verRespuestaModal = document.getElementById('verRespuestaModal');
        if (verRespuestaModal) {
            verRespuestaModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const email = button.getAttribute('data-email');
                const mensaje = button.getAttribute('data-mensaje');
                const respuesta = button.getAttribute('data-respuesta');
                
                verRespuestaModal.querySelector('#ver-email').value = email;
                verRespuestaModal.querySelector('#ver-original').value = mensaje;
                verRespuestaModal.querySelector('#ver-respuesta').value = respuesta;
            });
        }
        
        // Validación del lado del cliente para formulario de respuesta
        const formResponder = document.getElementById('formResponder');
        if (formResponder) {
            formResponder.addEventListener('submit', function(event) {
                if (!formResponder.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                formResponder.classList.add('was-validated');
            }, false);
        }
    });
</script>
