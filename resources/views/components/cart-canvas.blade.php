{{-- Canvas para el carrito con bootstrap --}}
<div class="offcanvas offcanvas-end bg-crema" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Tu Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <hr class="my-0" style="border-top: 2px solid var(--marron); opacity: 0.25;">
    <div class="offcanvas-body">
        <div id="carrito-items"></div>

        <div id="carrito-total" class="mt-3 pt-3 border-top d-none">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong id="total-precio">$0</strong>
            </div>
            @guest
                <a href="{{ route('login') }}" class="btn btn-warning w-100 fw-bold">Inicia sesión para iniciar tu compra</a>
            @else
                <button id="btn-comprar" class="btn btn-success w-100 fw-bold">
                    <span id="btn-comprar-texto">Comprar</span>
                    <span id="btn-comprar-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            @endguest
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
                total += item.precio * item.cantidad;
                const esMaxStock = item.cantidad >= item.stock;
                return `
                <div class="card mb-2" style="max-height: 100px;">
                    <div class="card-body p-2 d-flex align-items-center">
                        <img src="${item.imagen ? '/img/' + item.imagen : '/img/hambur1.png'}" alt="${item.nombre}" 
                             class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <h6 class="mb-1" style="font-size: 14px;">${item.nombre}</h6>
                            <small class="text-muted">$${item.precio}</small>
                        </div>
                        <div class="d-flex align-items-center gap-1 me-2">
                            <button class="btn btn-sm btn-outline-secondary px-2 py-0 btn-disminuir" data-index="${index}">-</button>
                            <span class="fw-bold px-1" style="font-size: 14px;">${item.cantidad}</span>
                            <button class="btn btn-sm btn-outline-secondary px-2 py-0 btn-incrementar" data-index="${index}" ${esMaxStock ? 'disabled' : ''}>+</button>
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

    // Incrementar cantidad
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-incrementar')) {
            const btn = e.target.closest('.btn-incrementar');
            const index = parseInt(btn.dataset.index);
            let cart = JSON.parse(localStorage.getItem('carrito')) || [];
            
            if (cart[index]) {
                if (cart[index].cantidad < cart[index].stock) {
                    cart[index].cantidad += 1;
                    localStorage.setItem('carrito', JSON.stringify(cart));
                    window.dispatchEvent(new CustomEvent('cart-updated'));
                }
            }
        }
    });

    // Disminuir cantidad
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-disminuir')) {
            const btn = e.target.closest('.btn-disminuir');
            const index = parseInt(btn.dataset.index);
            let cart = JSON.parse(localStorage.getItem('carrito')) || [];
            
            if (cart[index]) {
                if (cart[index].cantidad > 1) {
                    cart[index].cantidad -= 1;
                } else {
                    cart.splice(index, 1);
                }
                localStorage.setItem('carrito', JSON.stringify(cart));
                window.dispatchEvent(new CustomEvent('cart-updated'));
            }
        }
    });

    // Eliminar item
    document.addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-item')) {
            const btn = e.target.closest('.eliminar-item');
            const index = parseInt(btn.dataset.index);
            let cart = JSON.parse(localStorage.getItem('carrito')) || [];
            cart.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent('cart-updated'));
        }
    });

    // Cargar al abrir el offcanvas
    document.getElementById('offcanvasCart').addEventListener('shown.bs.offcanvas', mostrarCarrito);

    // Sincronizar dinámicamente ante cualquier actualización del carrito
    window.addEventListener('cart-updated', mostrarCarrito);

    // Mostrar Toast de Error
    function mostrarErrorToast(mensaje) {
        const toastEl = document.getElementById('errorToast');
        const messageEl = document.getElementById('errorToastMessage');
        if (toastEl && messageEl) {
            messageEl.textContent = mensaje;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        } else {
            alert(mensaje);
        }
    }

    // Comprar
    document.addEventListener('DOMContentLoaded', function() {
        const btnComprar = document.getElementById('btn-comprar');
        if (btnComprar) {
            btnComprar.addEventListener('click', async function() {
                const cart = JSON.parse(localStorage.getItem('carrito')) || [];
                if (cart.length === 0) return;

                const btnTexto = document.getElementById('btn-comprar-texto');
                const btnSpinner = document.getElementById('btn-comprar-spinner');
                btnComprar.disabled = true;
                btnTexto.textContent = 'Procesando...';
                btnSpinner.classList.remove('d-none');

                try {
                    const response = await fetch('/carrito/comprar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ carrito: cart })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        localStorage.removeItem('carrito');
                        
                        // Notificar la actualización (el stock bajó en DB, el carrito local se vació)
                        window.dispatchEvent(new CustomEvent('cart-updated'));

                        // Cerrar el offcanvas
                        const offcanvasEl = document.getElementById('offcanvasCart');
                        const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                        if (offcanvas) {
                            offcanvas.hide();
                        }

                        // Mostrar toast
                        const toastEl = document.getElementById('compraToast');
                        if (toastEl) {
                            const toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }
                    } else {
                        mostrarErrorToast(data.message || 'Hubo un problema al procesar tu compra.');
                    }
                } catch (error) {
                    console.error(error);
                    mostrarErrorToast('Ocurrió un error inesperado al conectar con el servidor.');
                } finally {
                    btnComprar.disabled = false;
                    btnTexto.textContent = 'Comprar';
                    btnSpinner.classList.add('d-none');
                }
            });
        }
    });
</script>
