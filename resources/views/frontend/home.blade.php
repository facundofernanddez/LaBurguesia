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
