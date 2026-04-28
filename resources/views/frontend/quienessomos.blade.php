<x-layout title="Quiénes Somos">
    <h1 class="mb-4 text-center"><span class="bg-blur p-2">Quiénes Somos</span></h1>

    <div class="row align-items-center mb-5">
        <!-- Texto a la izquierda -->
        <div class="col-xl-7 mb-4">
            <x-card-beige>
                <h2 class="mb-3" style="color: #502314;">Nuestra Historia</h2>
                <p class="lead">Las mejores hamburguesas de la ciudad desde 2018.</p>
                <p>
                    <strong>La Burguesia</strong> nació con una misión simple: ofrecer hamburguesas artesanales, con
                    ingredientes frescos y de calidad suprema.
                </p>
                <p>
                    Nuestro equipo está conformado por pasión por la buena comida y el servicio impecable.
                    Cada hamburguesa es preparada con cariño para que disfrutes una experiencia única.
                </p>
            </x-card-beige>
        </div>


        <!-- Carrusel de empleados a la derecha -->
        <div class="col-xl-5 ">

            <x-carrusel :imagenes="[
                [
                    'src' => '/img/chef.jpg',
                    'alt' => 'Empleado 1',
                    'titulo' => 'Chef Principal',
                    'descripcion' => 'El líder de nuestra cocina',
                ],
                [
                    'src' => '/img/personal.jpg',
                    'alt' => 'Empleado 2',
                    'titulo' => 'Personal de Atención',
                    'descripcion' => 'El rostro amigable de nuestra tienda',
                ],
                [
                    'src' => '/img/subchef.jpg',
                    'alt' => 'Empleado 3',
                    'titulo' => 'Subchef',
                    'descripcion' => 'El ayudante del Chef Principal',
                ],
            ]" />
        </div>
    </div>

    <!-- Stats con fondo rojo degradado -->
    <div class="row text-center">
        <div class="col-lg-4 mb-3">
            <div class="stat-card p-4 rounded-4">
                <h2 class="fw-bold" style="color: #FFC72C;">5+</h2>
                <p class="text-white mb-0">Años de Experiencia</p>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="stat-card p-4 rounded-4">
                <h2 class="fw-bold" style="color: #FFC72C;">50K+</h2>
                <p class="text-white mb-0">Clientes Satisfechos</p>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="stat-card p-4 rounded-4">
                <h2 class="fw-bold" style="color: #FFC72C;">15+</h2>
                <p class="text-white mb-0">Variedades de Hamburguesas</p>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- NUEVA SECCIÓN: NUESTRO EQUIPO -->
    <!-- ============================================ -->
    <div class="container my-5">
        <!-- Header de sección -->
        <div class="d-flex justify-content-center text-center mb-5">
            <div class="bg-blur p-2">
                <h2 style="color: #502314;">Nuestro Equipo</h2>
                <p class="lead">Conoc&eacute; a quienes hacen posible La Burguesia</p>
            </div>
        </div>

        <!-- Empleado 1: Imagen a la izquierda -->
        <div class="card border-0 shadow mb-4" style="border-radius: 20px;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="/img/chef.jpg" alt="Carlos M&eacute;ndez" class="img-fluid"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 15px; margin: 20px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="fw-bold" style="color: #502314;">Carlos M&eacute;ndez</h3>
                        <p class="fw-bold" style="color: #D62300; font-size: 0.9rem;">Chef Principal</p>
                        <p class="mb-0">Especialista en parrilla con m&aacute;s de 10 a&ntilde;os de experiencia. Su
                            pasi&oacute;n por la cocina lo ha llevado a crear las recetas cls&aacute;sicas que hacen
                            &uacute;nico a La Burguesia.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empleado 2: Imagen a la izquierda -->
        <div class="card border-0 shadow mb-4" style="border-radius: 20px;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="/img/subchef.jpg" alt="Mar&iacute;a L&oacute;pez" class="img-fluid"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 15px; margin: 20px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="fw-bold" style="color: #502314;">Mar&iacute;a L&oacute;pez</h3>
                        <p class="fw-bold" style="color: #D62300; font-size: 0.9rem;">Subchef (Cocinera)</p>
                        <p class="mb-0">Apasionada por la cocina artesanal, Mar&iacute;a se asegura de que cada
                            hamburguesa est&eacute; perfecta. Su dedicaci&oacute;n y creatividad son clave en nuestra
                            cocina.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empleado 3: Imagen a la izquierda -->
        <div class="card border-0 shadow mb-4" style="border-radius: 20px;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="/img/personal.jpg" alt="Pedro Ram&iacute;rez" class="img-fluid"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 15px; margin: 20px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="fw-bold" style="color: #502314;">Pedro Ram&iacute;rez</h3>
                        <p class="fw-bold" style="color: #D62300; font-size: 0.9rem;">Gerente de Atenci&oacute;n al
                            Cliente</p>
                        <p class="mb-0">Con m&aacute;s de 5 a&ntilde;os en el sector gastron&oacute;mico, Pedro
                            garantiza que cada cliente tenga una experiencia excepcional desde el primer contacto.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empleado 4: Imagen a la izquierda -->
        <div class="card border-0 shadow mb-4" style="border-radius: 20px;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="/img/repartidor.jpg" alt="Jorge Herrera" class="img-fluid"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 15px; margin: 20px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="fw-bold" style="color: #502314;">Jorge Herrera</h3>
                        <p class="fw-bold" style="color: #D62300; font-size: 0.9rem;">Repartidor</p>
                        <p class="mb-0">El alma de las entregas a domicilio. Jorge se asegura de que tu hamburguesa
                            llegue caliente y a tiempo, con la sonrisa que nos caracteriza.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empleado 5: Imagen a la izquierda -->
        <div class="card border-0 shadow mb-4" style="border-radius: 20px;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <img src="/img/marketing.jpg" alt="Sof&iacute;a Torres" class="img-fluid"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 15px; margin: 20px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="fw-bold" style="color: #502314;">Sof&iacute;a Torres</h3>
                        <p class="fw-bold" style="color: #D62300; font-size: 0.9rem;">Marketing & Redes Sociales</p>
                        <p class="mb-0">Creativa y estratégica, Sof&iacute;a maneja nuestra presencia digital. Con su
                            talento logramos conectar con ustedes y mantenerlos informados de las mejores ofertas y
                            novedades.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos para el hover -->
    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }
    </style>

</x-layout>
