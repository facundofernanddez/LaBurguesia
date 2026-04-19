<x-layout title="Inicio">
    <div class="row align-items-center py-4">
        <!-- Texto a la izquierda con fondo semitransparente -->
        <div class="col-md-4">
            <div class="p-4 rounded" style="background-color: rgba(253, 243, 231, 0.85);">
                <h1 class="display-5 fw-bold" style="color: #502314;">Las Mejores Hamburguesas</h1>
                <p class="lead">Disfrutá del auténtico sabor artesanal</p>
                <p class="mb-3">Desde 2018 preparando las burgers más deliciosas de la ciudad.</p>
                <a href="/catalogo" class="btn btn-lg mt-2" style="background-color: #D62300; color: white;">Ver Menú</a>
            </div>
        </div>
        
        <!-- Carrusel a la derecha -->
        <div class="col-md-8">
            <x-carrusel/>
        </div>
    </div>
</x-layout>