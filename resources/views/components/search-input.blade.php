@props([
    'id',
    'placeholder' => 'Buscar...'
])

<div class="input-group mb-3">
    <span class="input-group-text bg-marron text-white border-marron">
        <i class="bi bi-search"></i>
    </span>
    <input type="text" id="{{ $id }}" class="form-control border-marron" placeholder="{{ $placeholder }}">
</div>

<style>
    .border-marron {
        border-color: var(--marron) !important;
    }
    .border-marron:focus {
        border-color: var(--rojo) !important;
        box-shadow: 0 0 0 0.25rem rgba(214, 35, 0, 0.25) !important;
    }
</style>
