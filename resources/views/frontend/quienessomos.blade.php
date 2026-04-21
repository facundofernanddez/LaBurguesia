<x-layout title="Quiénes Somos">
  <h1 class="mb-4 text-center">Quiénes Somos</h1>
  
  <div class="row align-items-center mb-5">
    <!-- Texto a la izquierda -->
    <div class="col-md-5">
      <h2 class="mb-3" style="color: #502314;">Nuestra Historia</h2>
      <p class="lead">Las mejores hamburguesas de la ciudad desde 2018.</p>
      <p>
        <strong>La Burguesia</strong> nació con una misión simple: ofrecer hamburguesas artesanales, con ingredientes frescos y de calidad suprema.
      </p>
      <p>
        Nuestro equipo está conformado por pasión por la buena comida y el servicio impecable.
        Cada hamburguesa es preparada con cariño para que disfrutes una experiencia única.
      </p>
    </div>
    
    <!-- Carrusel de empleados a la derecha -->
    <div class="col-md-7">
      <div id="carouselEmpleados" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500">
        <div class="carousel-inner">
          <!-- Empleado 1 -->
          <div class="carousel-item active">
            <div class="position-relative">
              <img src="{{ asset('img/chef.jpg') }}" class="d-block w-100 rounded-4 img-carrusel" alt="Chef">
              <div class="overlay">
                <h4 class="text-white mb-1">Carlos García</h4>
                <p class="text-white mb-0">Chef Principal</p>
              </div>
            </div>
          </div>
          <!-- Empleado 2 -->
          <div class="carousel-item">
            <div class="position-relative">
              <img src="{{ asset('img/subChef.jpg') }}" class="d-block w-100 rounded-4 img-carrusel" alt="Cocinero">
              <div class="overlay">
                <h4 class="text-white mb-1">María López</h4>
                <p class="text-white mb-0">Subchef</p>
              </div>
            </div>
          </div>
          <!-- Empleado 3 -->
          <div class="carousel-item">
            <div class="position-relative">
              <img src="{{ asset('img/personal.jpg') }}" class="d-block w-100 rounded-4 img-carrusel" alt="Camarero">
              <div class="overlay">
                <h4 class="text-white mb-1">Pedro Sánchez</h4>
                <p class="text-white mb-0">Atención al Cliente</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Miniaturas -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselEmpleados" data-bs-slide-to="0" class="active" aria-current="true"></button>
          <button type="button" data-bs-target="#carouselEmpleados" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#carouselEmpleados" data-bs-slide-to="2"></button>
        </div>
        
        <!-- Flechas -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselEmpleados" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselEmpleados" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </div>
  
  <!-- Stats con fondo rojo degradado -->
  <div class="row text-center">
    <div class="col-md-4 mb-3">
      <div class="stat-card p-4 rounded-4">
        <h2 class="fw-bold" style="color: #FFC72C;">5+</h2>
        <p class="text-white mb-0">Años de Experiencia</p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="stat-card p-4 rounded-4">
        <h2 class="fw-bold" style="color: #FFC72C;">50K+</h2>
        <p class="text-white mb-0">Clientes Satisfechos</p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="stat-card p-4 rounded-4">
        <h2 class="fw-bold" style="color: #FFC72C;">15+</h2>
        <p class="text-white mb-0">Variedades de Hamburguesas</p>
      </div>
    </div>
  </div>
  
  <style>
    .img-carrusel {
      height: 400px;
      object-fit: cover;
      width: 100%;
      object-position: center;
      object-position: bottom;
    }
    .rounded-4 {
      border-radius: 20px;
    }
    .overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
      padding: 30px 20px 20px;
      border-bottom-left-radius: 20px;
      border-bottom-right-radius: 20px;
    }
    .carousel-item {
      transition: transform 0.6s ease;
      max-height: 400px;
    }
    #carouselEmpleados:hover .carousel-item {
      animation-play-state: paused;
    }
    .stat-card {
      background: linear-gradient(135deg, #D62300 0%, #a91b00 100%);
      box-shadow: 0 10px 25px rgba(214, 35, 0, 0.3);
    }
    .carousel-indicators button {
      background-color: #D62300;
      opacity: 0.5;
    }
    .carousel-indicators button.active {
      opacity: 1;
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: #D62300;
      border-radius: 50%;
      background-size: 50%;
      width: 3rem;
      height: 3rem;
    }
  </style>
</x-layout>