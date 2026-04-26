@props(['item'])

<div class="card mb-2" style="max-height: 100px;">
    <div class="card-body p-2 d-flex align-items-center">
        <img src="{{ asset('img/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" class="rounded me-3"
            style="width: 60px; height: 60px; object-fit: cover;">
        <div class="flex-grow-1">
            <h6 class="mb-1">{{ $item['nombre'] }}</h6>
            <small class="text-muted">${{ $item['precio'] }}</small>
        </div>
        <button class="btn btn-sm btn-danger eliminar-item" data-id="{{ $item['id'] }}">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>
