{{-- Canvas para el carrito con bootstrap --}}
<div class="offcanvas offcanvas-end bg-crema" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Tu Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="carrito-items"></div>

        <div id="carrito-total" class="mt-3 pt-3 border-top d-none">
            <div class="d-flex justify-content-between">
                <strong>Total:</strong>
                <strong id="total-precio">$0</strong>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarCarrito() {
        const cart = JSON.parse(localStorage.getItem('carrito')) || [];
        const container = document.getElementById('carrito-items');
        const totalContainer = document.getElementById('carrito-total');
        const totalPrecio = document.getElementById('total-precio');

        if (cart.length === 0) {
            container.innerHTML = '<p class="text-center">Tu carrito está vacío</p>';
            totalContainer.classList.add('d-none');
        } else {
            let total = 0;
            container.innerHTML = cart.map((item, index) => {
                total += item.precio;
                return `
                <div class="card mb-2" style="max-height: 100px;">
                    <div class="card-body p-2 d-flex align-items-center">
                        <img src="${item.imagen ? '/img/' + item.imagen : '/img/hambur1.png'}" alt="${item.nombre}" 
                             class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">${item.nombre}</h6>
                            <small class="text-muted">$${item.precio}</small>
                        </div>
                        <button class="btn btn-sm btn-danger eliminar-item" data-index="${index}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`;
            }).join('');

            totalPrecio.textContent = '$' + total;
            totalContainer.classList.remove('d-none');
        }
    }

    // Eliminar item
    document.addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-item')) {
            const btn = e.target.closest('.eliminar-item');
            const index = parseInt(btn.dataset.index);
            let cart = JSON.parse(localStorage.getItem('carrito')) || [];
            cart.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(cart));
            mostrarCarrito();
        }
    });

    // Cargar al abrir el offcanvas
    document.getElementById('offcanvasCart').addEventListener('shown.bs.offcanvas', mostrarCarrito);
</script>
