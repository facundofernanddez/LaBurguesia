<x-layout title="Inicio">
    @php
        $imagenesCarrusel = [];
        foreach ($carruselProductos as $p) {
            $imagenesCarrusel[] = [
                'src' => asset('img/' . $p->imagen),
                'alt' => $p->nombre,
                'titulo' => $p->nombre,
                'descripcion' => $p->descripcion
            ];
        }
    @endphp
    <div class="row align-items-center py-4">
        <!-- Texto a la izquierda -->
        <div class="col-lg-7 mb-4">
            <x-card-beige>
                <div class="row align-items-center">
                    <div class="col-12 col-sm-4 mb-3 mb-sm-0 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo.png') }}" alt="La Burguesia" class="img-fluid"
                            style="max-width: 150px;">
                    </div>
                    <div class="col-12 col-sm-8 text-center text-sm-start">
                        <h2 class="fw-bold" style="color: #502314;">La burguesía</h2>
                        <p class="lead fw-medium">Disfrutá del auténtico sabor artesanal</p>
                        <p class="mb-3 fw-medium">Desde 2018 preparando las burgers más deliciosas de la ciudad.</p>
                        <a href="/catalogo" class="btn btn-lg mt-2" style="background-color: #D62300; color: white;">Ver
                            Menú</a>
                    </div>
                </div>
            </x-card-beige>
        </div>

        <!-- Carrusel a la derecha -->
        <div class="col-lg-5">
            @if (count($imagenesCarrusel) > 0)
                <a href="/catalogo">
                    <x-carrusel :imagenes="$imagenesCarrusel" />
                </a>
            @else
                <div class="d-flex align-items-center justify-content-center bg-white shadow-sm" style="height: 400px; border-radius: 10px; border: 1px solid rgba(0, 0, 0, 0.05);">
                    <img src="{{ asset('img/logo.png') }}" alt="La Burguesia" class="img-fluid" style="max-height: 280px; object-fit: contain;">
                </div>
            @endif
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

    <!-- Productos Destacados -->
    <section class="py-5">
        <div class="container">
            <!-- Título con fondo para que resalte -->
            <div class="text-center mb-5">
                <div class="bg-blur d-inline-block px-4 py-2 rounded-3 shadow-sm">
                    <h2 class="fw-bold mb-1" style="color: #502314;">Productos destacados</h2>
                    <p class="text-muted mb-0">Los más elegidos por nuestros clientes</p>
                </div>
            </div>

            <!-- Grid de productos -->
            <div class="row g-4">
                @forelse($destacados as $producto)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset($producto->imagen ? 'img/' . $producto->imagen : 'img/logo.png') }}" class="card-img" alt="{{ $producto->nombre }}" style="object-fit: cover; height: 280px;">
                            <div class="card-body bg-white d-flex flex-column">
                                <div>
                                    <span class="badge bg-secondary bg-opacity-25 text-dark mb-2">{{ ucfirst($producto->categoria) }}</span>
                                    <h5 class="card-title fw-bold" style="color: #502314;">{{ $producto->nombre }}</h5>
                                    <p class="card-text text-muted small">{{ $producto->descripcion }}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                                    <span class="fw-bold fs-5" style="color: #D62300;">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                    <a href="/catalogo?categoria={{ urlencode($producto->categoria) }}&producto={{ $producto->id }}" class="btn btn-sm text-white" style="background-color: #D62300; border-radius: 20px;">Pedir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="bg-blur d-inline-block px-4 py-3 rounded-4 shadow-sm">
                            <p class="text-muted mb-0">¡Próximamente nuevos productos destacados!</p>
                            <a href="/catalogo" class="btn btn-sm text-white mt-2" style="background-color: #D62300; border-radius: 20px;">Ver catálogo completo</a>
                        </div>
                    </div>
                @endforelse
            </div>


        </div>
    </section>

    <!-- Por qué elegirnos -->
    <section class="py-5">
        <div class="container">
            <!-- Contenedor principal con contraste -->
            <div class="rounded-4 p-4 p-md-5"
                style="background: #f0e9dd; backdrop-filter: blur(4px); box-shadow: 0 15px 40px rgba(0,0,0,0.08);">

                <!-- Título -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="color: #502314; font-size: 2rem;">¿Por qué elegirnos?</h2>
                    <p class="text-secondary" style="color: #555 !important;">La experiencia burger que no vas a
                        olvidar
                    </p>
                </div>

                <!-- Grid de razones -->
                <div class="row g-4 text-center">
                    <!-- Razón 1 -->
                    <div class="col-12 col-md-4">
                        <div class="p-4 h-100 rounded-4 bg-white border-0"
                            style="box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; ">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px; background-color: #D62300; box-shadow: 0 8px 20px rgba(214,35,0,0.3);">
                                <i class="bi bi-fire text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 class="fw-bold" style="color: #502314; font-weight: 600;">Frescura garantizada</h5>
                            <p class="text-secondary mb-0" style="color: #555 !important; line-height: 1.5;">
                                Ingredientes seleccionados cada día, carnes de primera calidad</p>
                        </div>
                    </div>

                    <!-- Razón 2 -->
                    <div class="col-12 col-md-4">
                        <div class="p-4 h-100 rounded-4 bg-white border-0"
                            style="box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px; background-color: #D62300; box-shadow: 0 8px 20px rgba(214,35,0,0.3);">
                                <i class="bi bi-heart text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 class="fw-bold" style="color: #502314; font-weight: 600;">Recetas únicas</h5>
                            <p class="text-secondary mb-0" style="color: #555 !important; line-height: 1.5;">Salsas
                                secretas y combinaciones que solo encontrás acá</p>
                        </div>
                    </div>

                    <!-- Razón 3 -->
                    <div class="col-12 col-md-4">
                        <div class="p-4 h-100 rounded-4 bg-white border-0"
                            style="box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px; background-color: #D62300; box-shadow: 0 8px 20px rgba(214,35,0,0.3);">
                                <i class="bi bi-truck text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 class="fw-bold" style="color: #502314; font-weight: 600;">Envío rápido</h5>
                            <p class="text-secondary mb-0" style="color: #555 !important; line-height: 1.5;">Llega
                                caliente y fresca a tu puerta en minutos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>

{{-- 
agregar texto en el carrusel ✅
agregar los iconos de las redes sociales en el footer ✅
agregar el icono de carrito en el navbar ✅
agregar productos al carrito ✅
la imagen del carrito tiene que quedar por fuera del menu despegable ✅
agregar las imagenes que faltan de los productos al catalogo 
agregar un boton de "ver mas" en cada card del catalogo ✅
agregar mapa en la pagina de contacto ✅
poner titulo comercializacion en el medio de la pagina comercializacion ✅
agregar filtro al menu ✅
los fondos cambiar que no sean translucidos ✅
ajustar los tamaños de las tarjetas con el carrusel
canvas para el carrito ✅
en el home agregar tarjetas de los productos que vendemos y que redireccione al catalogo y filtrado
Ofertas y promociones
Los mas pedidos
En nosotros agregar una imagen del negocio y del equipo (guiarme con una pagina por ejemplo bercomat)
En quienes somos agregar un ejemplo de vision y mision
agregar mas personal en quienes somos
Agregar mas info en todas las paginas para que no queden tan simples
agregar motivo al formulario de contacto ✅
mejorar responsive ✅
refresh y limpiar los campos ✅
mantener campo con valor original cuando vacio el campo en el formularios ✅
imagen obligatoria al crear producto ✅
no eliminar producto de la base solo cambiar estado ✅
desabilitar el cambio de admin y cliente ✅
el admin no puede autodesactivarse ✅
mas datos al finalizar la compra ✅
responder las consultas desde las consultas hacia el correo
en consulta cuando esta registrado autocompletar campos de correo y nombre ✅
 --}}
