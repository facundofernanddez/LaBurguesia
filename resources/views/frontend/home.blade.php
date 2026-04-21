<x-layout title="Inicio">
    <div class="row align-items-center py-4">
        <!-- Texto a la izquierda con fondo semitransparente -->
            <div class="col-lg-4">
                <x-card-beige>
                <h2 class="fw-bold" style="color: #502314;">Las Mejores Hamburguesas</h2>
                <p class="lead">Disfrutá del auténtico sabor artesanal</p>
                <p class="mb-3">Desde 2018 preparando las burgers más deliciosas de la ciudad.</p>
                <a href="/catalogo" class="btn btn-lg mt-2" style="background-color: #D62300; color: white;">Ver Menú</a>
                </x-card-beige>
            </div>
        
        <!-- Carrusel a la derecha -->
        <div class="col-md-8">
            <x-carrusel/>
        </div>
    </div>
</x-layout>