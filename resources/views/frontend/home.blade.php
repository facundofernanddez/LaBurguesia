<x-layout title="Inicio">
    <div class="row align-items-center py-4">
        <!-- Texto a la izquierda con fondo semitransparente -->
        <div class="col-lg-4">
            <x-card-beige>
                <h2 class="fw-bold" style="color: #502314;">La burguesía</h2>
                <p class="lead fw-medium">Disfrutá del auténtico sabor artesanal</p>
                <p class="mb-3 fw-medium">Desde 2018 preparando las burgers más deliciosas de la ciudad.</p>
                <a href="/catalogo" class="btn btn-lg mt-2" style="background-color: #D62300; color: white;">Ver Menú</a>
            </x-card-beige>
        </div>

        <!-- Carrusel a la derecha -->
        <div class="col-md-8">
            <a href="/catalogo">
                <x-carrusel :imagenes="[
                    [
                        'src' => '/img/clasica.png',
                        'alt' => 'Classic Burger',
                        'titulo' => 'Classic Burger',
                        'descripcion' => 'Hamburguesa clásica con lechuga, tomate y nuestra salsa secreta.',
                    ],
                    [
                        'src' => '/img/cheddar.png',
                        'alt' => 'Cheese Burger',
                        'titulo' => 'Cheese Burger',
                        'descripcion' => 'Con queso cheddar fundido y tocino crujiente',
                    ],
                    [
                        'src' => '/img/cebolla.png',
                        'alt' => 'Bacon Burger',
                        'titulo' => 'Bacon Burger',
                        'descripcion' => 'Doble porción de tocino y cebolla crispy',
                    ],
                ]" /></a>
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

    <!-- Productos Destacados -->
    <section class="py-5">
        <div class="container">
            <!-- Título con fondo para que resalte -->
            <div class="text-center mb-5">
                <div class="bg-crema d-inline-block px-4 py-2 rounded-3 shadow-sm">
                    <h2 class="fw-bold mb-1" style="color: #502314;">Nuestros Productos</h2>
                    <p class="text-muted mb-0">Los más elegidos por nuestros clientes</p>
                </div>
            </div>

            <!-- Grid de productos -->
            <div class="row g-4">
                <!-- Producto 1 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="/img/clasica.png" class="card-img-top" alt="Whopper Clásica" style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-secondary bg-opacity-25 text-dark mb-2">Hamburguesas</span>
                            <h5 class="card-title fw-bold" style="color: #502314;">Whopper Clásica</h5>
                            <p class="card-text text-muted small">Carne 100% vaccuna con lechuga, tomate y cebolla</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5" style="color: #D62300;">$4.500</span>
                                <span class="text-warning"><i class="bi bi-star-fill"></i> 4.8</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <button class="btn btn-sm btn-rojo">Agregar</button>
                        </div>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="/img/cheddar.png" class="card-img-top" alt="Cheese Burger" style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-danger bg-opacity-25 text-danger mb-2">Popular</span>
                            <h5 class="card-title fw-bold" style="color: #502314;">Cheese Burger</h5>
                            <p class="card-text text-muted small">Con doble queso cheddar y tocino crujiente</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5" style="color: #D62300;">$5.200</span>
                                <span class="text-warning"><i class="bi bi-star-fill"></i> 4.9</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <button class="btn btn-sm btn-rojo">Agregar</button>
                        </div>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="/img/papas1.png" class="card-img-top" alt="Papas Fritas" style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-secondary bg-opacity-25 text-dark mb-2">Acompañamientos</span>
                            <h5 class="card-title fw-bold" style="color: #502314;">Papas Fritas</h5>
                            <p class="card-text text-muted small">Papas crujientes y sazonadas al estilo americano</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5" style="color: #D62300;">$5.800</span>
                                <span class="text-warning"><i class="bi bi-star-fill"></i> 4.7</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <button class="btn btn-sm btn-rojo">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

    
        </div>
    </section>

    <!-- Por qué elegirnos -->
    <section class="py-5">
        <div class="container">
            <!-- Contenedor principal con contraste -->
            <div class="rounded-4 p-4 p-md-5" style="background: #f0e9dd; backdrop-filter: blur(4px); box-shadow: 0 15px 40px rgba(0,0,0,0.08);">
                
                <!-- Título -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="color: #502314; font-size: 2rem;">¿Por qué elegirnos?</h2>
                    <p class="text-secondary" style="color: #555 !important;">La experiencia burger que no vas a olvidar</p>
                </div>

                <!-- Grid de razones -->
                <div class="row g-4 text-center">
                    <!-- Razón 1 -->
                    <div class="col-12 col-md-4">
                        <div class="p-4 h-100 rounded-4 bg-white border-0" style="box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background-color: #D62300; box-shadow: 0 8px 20px rgba(214,35,0,0.3);">
                                <i class="bi bi-fire text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 class="fw-bold" style="color: #502314; font-weight: 600;">Frescura garantizada</h5>
                            <p class="text-secondary mb-0" style="color: #555 !important; line-height: 1.5;">Ingredientes seleccionados cada día, carnes de primera calidad</p>
                        </div>
                    </div>

                    <!-- Razón 2 -->
                    <div class="col-12 col-md-4">
                        <div class="p-4 h-100 rounded-4 bg-white border-0" style="box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background-color: #D62300; box-shadow: 0 8px 20px rgba(214,35,0,0.3);">
                                <i class="bi bi-heart text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 class="fw-bold" style="color: #502314; font-weight: 600;">Recetas únicas</h5>
                            <p class="text-secondary mb-0" style="color: #555 !important; line-height: 1.5;">Salsas secretas y combinaciones que solo encontrás acá</p>
                        </div>
                    </div>

                    <!-- Razón 3 -->
                    <div class="col-12 col-md-4">
                        <div class="p-4 h-100 rounded-4 bg-white border-0" style="box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background-color: #D62300; box-shadow: 0 8px 20px rgba(214,35,0,0.3);">
                                <i class="bi bi-truck text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h5 class="fw-bold" style="color: #502314; font-weight: 600;">Envío rápido</h5>
                            <p class="text-secondary mb-0" style="color: #555 !important; line-height: 1.5;">Llega caliente y fresca a tu puerta en minutos</p>
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
agregar motivo al formulario de contacto
mejorar responsive
 --}}
