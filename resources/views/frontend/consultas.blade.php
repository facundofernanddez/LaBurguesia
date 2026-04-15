<x-layout title="Consultas">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body p-4">
          <h2 class="mb-4">Envíanos tu Consulta</h2>
          <p class="mb-4">Completa el formulario y te responderemos a la brevedad.</p>
          
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
              <label class="form-label">Teléfono</label>
              <input type="tel" class="form-control" placeholder="Tu teléfono">
            </div>
            
            <div class="mb-3">
              <label class="form-label">Mensaje</label>
              <textarea class="form-control" rows="5" placeholder="Tu consulta..."></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg">Enviar Consulta</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-layout>