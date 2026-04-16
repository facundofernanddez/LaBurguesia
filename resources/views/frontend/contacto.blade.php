<x-layout title="Contacto">
  <div class="row">
    <div class="col-md-5">
      <h2>Información de Contacto</h2>
      
      <div class="mb-4">
        <h5 class="text-rojo">Datos de la Empresa</h5>
        <p class="mb-1"><strong>Razón Social:</strong> La Burguesia S.R.L.</p>
        <p class="mb-1"><strong>Domicilio:</strong> Av. Principal 1234, Ciudad</p>
        <p class="mb-1"><strong>Teléfono:</strong> (011) 1234-5678</p>
        <p class="mb-1"><strong>Email:</strong> contacto@laburguesia.com</p>
      </div>
      
      <div>
        <h5 class="text-rojo">Formulario de Contacto</h5>
        <form>
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Tu nombre">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="tu@email.com">
          </div>
          <div class="mb-3">
            <label class="form-label">Mensaje</label>
            <textarea class="form-control" rows="4" placeholder="Tu mensaje..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary mb-1">Enviar</button>
        </form>
      </div>
    </div>
    
    <div class="col-md-7">
      <div class="p-4 text-center text-white bg-marron rounded">
        <h3 class="mb-3">🍔 ¡Visítanos!</h3>
        <p>Estamos esperándote para que pruebes las mejores hamburguesas.</p>
      </div>
    </div>
  </div>
</x-layout>