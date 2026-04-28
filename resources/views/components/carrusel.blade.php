@props(['imagenes' => []])

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-inner">
        @foreach ($imagenes as $index => $imagen)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $imagen['src'] }}" class="d-block w-100 carousel-img" alt="{{ $imagen['alt'] }}">

                <div class="carousel-caption d-none d-md-block">
                    <h5 class="mb-3"><span class="bg-blur p-2">{{ $imagen['titulo'] ?? 'Título de la imagen' }}</span>
                    </h5>
                    {{-- <p><span class="bg-blur p-2">{{ $imagen['descripcion'] ?? 'Descripción de la imagen' }}</span></p> --}}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Miniaturas -->
    <div class="carousel-indicators">
        @foreach ($imagenes as $index => $imagen)
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $index }}"
                class="{{ $index === 0 ? 'active' : '' }}" {{ $index === 0 ? 'active' : '' }}>
            </button>
        @endforeach
    </div>

    <!-- Flechas -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
