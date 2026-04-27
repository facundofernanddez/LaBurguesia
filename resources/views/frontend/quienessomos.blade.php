<x-layout title="Quiénes Somos">
    <h1 class="mb-4 text-center"><span class="bg-blur p-2">Quiénes Somos</span></h1>

    <div class="row align-items-center mb-5">
        <!-- Texto a la izquierda -->
        <div class="col-xl-4 mb-4">
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
        <div class="col-xl-8 ">

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

</x-layout>
