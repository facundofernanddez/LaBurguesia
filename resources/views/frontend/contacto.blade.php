<x-layout title="Contacto">
    <div class="row">
        <div class="col-md-5">
            <x-card-beige>
                <h2>Información de Contacto</h2>

                <div class="mb-4">
                    <h5 class="text-rojo">Datos de la Empresa</h5>
                    <p class="mb-1"><strong>Razón Social:</strong> La Burguesia S.R.L.</p>
                    <p class="mb-1"><strong>Domicilio:</strong> Av. Ferre 5140</p>
                    <p class="mb-1"><strong>Teléfono:</strong> (011) 1234-5678</p>
                    <p class="mb-1"><strong>Email:</strong> contacto@laburguesia.com</p>
                </div>

                <div>
                    <h5 class="text-rojo">Formulario de Contacto</h5>
                    <form action="/contacto" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Tu nombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="tu@email.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Motivo</label>
                            <input type="text" name="motivo" class="form-control"
                                placeholder="El motivo de tu consulta">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mensaje</label>
                            <textarea class="form-control" name="mensaje" rows="4" placeholder="Tu mensaje..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-1">Enviar</button>
                    </form>
                </div>
            </x-card-beige>
        </div>

        <div class="col-md-7 gap-5">
            <div class="p-4 text-center text-white bg-rojo rounded">
                <h3 class="mb-3 f-white">🍔 ¡Visítanos!</h3>
                <p>Estamos esperándote para que pruebes las mejores hamburguesas.</p>
            </div>

            <!-- Mapa de Google -->
            <div class="mt-4">
                <iframe width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3165.8219!2d-58.4!3d-34.6!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb5c1f1c1f1f1%3A0x1f1f1f1f1f1f1f!2sAv.%20Ferre%205140%2C%20Corrientes!5e0!3m2!1ses!2sar!4v1234567890">
                </iframe>
            </div>
        </div>
    </div>
</x-layout>
