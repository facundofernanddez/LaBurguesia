<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto</title>

  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
  <x-layout>
    <div class="container mt-5">
      <div class="card shadow p-4">
        <h1 class="text-danger">¡Contáctanos!</h1>
        
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder="Tu nombre">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" placeholder="Tu correo electrónico">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" rows="4" placeholder="Escribe tu mensaje aquí"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </x-layout>

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>