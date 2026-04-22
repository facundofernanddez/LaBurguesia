@props(['imagenes' => []])

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
        @foreach ($imagenes as $index => $imagen)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $imagen['src'] }}" class="d-block w-100" alt="{{ $imagen['alt'] }}">
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
