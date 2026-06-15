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

<!-- Modal de Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow" style="background-color: #fcfaf6;">
            <div class="modal-header bg-marron text-white rounded-top-4 py-3">
                <h5 class="modal-title text-white" id="checkoutModalLabel">
                    <i class="bi bi-credit-card-2-front me-2"></i>Finalizar Compra
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formCheckout" class="needs-validation" novalidate>
                    <!-- Método de Entrega -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-marron">Método de Entrega</label>
                        <div class="d-flex gap-3">
                            <div class="flex-fill">
                                <input type="radio" class="btn-check" name="metodo_entrega" id="entrega_take_away" value="take_away" checked>
                                <label class="btn btn-outline-marron w-100 py-3 rounded-3" for="entrega_take_away">
                                    <i class="bi bi-shop fs-3 d-block mb-1"></i>
                                    Take Away<br><small class="text-success fw-bold">Gratis</small>
                                </label>
                            </div>
                            <div class="flex-fill">
                                <input type="radio" class="btn-check" name="metodo_entrega" id="entrega_delivery" value="delivery">
                                <label class="btn btn-outline-marron w-100 py-3 rounded-3" for="entrega_delivery">
                                    <i class="bi bi-bicycle fs-3 d-block mb-1"></i>
                                    Envío<br><small class="text-danger fw-bold">+$1.000</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Dirección de Envío (Oculta por defecto) -->
                    <div class="mb-4 d-none" id="contenedor-direccion">
                        <label for="direccion" class="form-label fw-bold text-marron">Dirección de Envío</label>
                        <input type="text" class="form-control rounded-3 border-marron" id="direccion" name="direccion" placeholder="Ej: Av. Siempreviva 742">
                        <div class="invalid-feedback">
                            Por favor ingresa una dirección de envío.
                        </div>
                    </div>

                    <!-- Forma de Pago -->
                    <div class="mb-4">
                        <label for="forma_pago" class="form-label fw-bold text-marron">Forma de Pago</label>
                        <select class="form-select rounded-3 border-marron" id="forma_pago" name="forma_pago" required>
                            <option value="efectivo" selected>Efectivo</option>
                            <option value="tarjeta">Tarjeta (Débito/Crédito)</option>
                            <option value="transferencia">Transferencia Bancaria</option>
                        </select>
                    </div>

                    <!-- Resumen del Pedido -->
                    <div class="p-3 bg-light rounded-3 mb-4 border border-dashed">
                        <h6 class="fw-bold text-marron mb-3"><i class="bi bi-receipt me-2"></i>Resumen</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Productos:</span>
                            <span class="fw-semibold text-dark" id="checkout-subtotal">$0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-success d-none" id="fila-checkout-envio">
                            <span class="text-muted">Envío a domicilio:</span>
                            <span class="fw-semibold">+$1.000</span>
                        </div>
                        <hr class="my-2 text-muted">
                        <div class="d-flex justify-content-between">
                            <strong class="text-marron">Total Final:</strong>
                            <strong class="text-danger fs-5" id="checkout-total">$0</strong>
                        </div>
                    </div>

                    <button type="submit" class="btn text-white w-100 py-3 fw-bold rounded-pill shadow-sm" style="background-color: #D62300; transition: all 0.3s ease;" id="btn-confirmar-compra">
                        <span id="btn-confirmar-texto">Confirmar Pedido</span>
                        <span id="btn-confirmar-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-outline-marron {
        color: #502314;
        border-color: #502314;
        background-color: transparent;
        transition: all 0.2s ease;
    }
    .btn-outline-marron:hover, .btn-check:checked + .btn-outline-marron {
        background-color: #502314 !important;
        color: #fff !important;
        border-color: #502314 !important;
    }
    .border-marron {
        border-color: #502314 !important;
    }
    .text-marron {
        color: #502314 !important;
    }
</style>

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
                         <img src="${item.imagen ? '/img/producto/' + item.imagen : '/img/hambur1.png'}" alt="${item.nombre}" 
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
        // Verificar si venimos de una compra exitosa
        if (sessionStorage.getItem('compra_exitosa') === 'true') {
            sessionStorage.removeItem('compra_exitosa');
            const toastEl = document.getElementById('compraToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        }

        const btnComprar = document.getElementById('btn-comprar');
        const checkoutModalEl = document.getElementById('checkoutModal');
        let checkoutModal = null;
        if (checkoutModalEl) {
            checkoutModal = new bootstrap.Modal(checkoutModalEl);
        }

        if (btnComprar && checkoutModal) {
            btnComprar.addEventListener('click', function() {
                const cart = JSON.parse(localStorage.getItem('carrito')) || [];
                if (cart.length === 0) return;

                // 1. Calculate subtotal
                let subtotal = 0;
                cart.forEach(item => {
                    subtotal += item.precio * item.cantidad;
                });

                // 2. Set subtotal in modal
                document.getElementById('checkout-subtotal').textContent = '$' + subtotal.toLocaleString('es-AR');

                // 3. Trigger change event to initialize delivery option logic
                const deliveryRad = document.querySelector('input[name="metodo_entrega"]:checked');
                updateCheckoutTotal(subtotal, deliveryRad.value);

                // 4. Hide offcanvas cart
                const offcanvasCartEl = document.getElementById('offcanvasCart');
                const offcanvasCart = bootstrap.Offcanvas.getInstance(offcanvasCartEl);
                if (offcanvasCart) {
                    offcanvasCart.hide();
                }

                // 5. Show checkout modal
                checkoutModal.show();
            });
        }

        // Logic for toggling address and recalculating total based on delivery option
        const entregaRadios = document.querySelectorAll('input[name="metodo_entrega"]');
        const contenedorDireccion = document.getElementById('contenedor-direccion');
        const inputDireccion = document.getElementById('direccion');
        const filaCheckoutEnvio = document.getElementById('fila-checkout-envio');

        function updateCheckoutTotal(subtotal, metodo) {
            const envio = metodo === 'delivery' ? 1000 : 0;
            const totalFinal = subtotal + envio;
            document.getElementById('checkout-total').textContent = '$' + totalFinal.toLocaleString('es-AR');
            
            if (envio > 0) {
                filaCheckoutEnvio.classList.remove('d-none');
                contenedorDireccion.classList.remove('d-none');
                inputDireccion.setAttribute('required', 'required');
            } else {
                filaCheckoutEnvio.classList.add('d-none');
                contenedorDireccion.classList.add('d-none');
                inputDireccion.removeAttribute('required');
                inputDireccion.value = '';
            }
        }

        entregaRadios.forEach(rad => {
            rad.addEventListener('change', function() {
                const cart = JSON.parse(localStorage.getItem('carrito')) || [];
                let subtotal = 0;
                cart.forEach(item => {
                    subtotal += item.precio * item.cantidad;
                });
                updateCheckoutTotal(subtotal, this.value);
            });
        });

        // Form Submit
        const formCheckout = document.getElementById('formCheckout');
        if (formCheckout) {
            formCheckout.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                if (!formCheckout.checkValidity()) {
                    formCheckout.classList.add('was-validated');
                    return;
                }

                const cart = JSON.parse(localStorage.getItem('carrito')) || [];
                if (cart.length === 0) return;

                const metodoEntrega = document.querySelector('input[name="metodo_entrega"]:checked').value;
                const direccion = inputDireccion.value.trim();
                const formaPago = document.getElementById('forma_pago').value;

                const btnConfirmar = document.getElementById('btn-confirmar-compra');
                const btnConfirmarTexto = document.getElementById('btn-confirmar-texto');
                const btnConfirmarSpinner = document.getElementById('btn-confirmar-spinner');

                btnConfirmar.disabled = true;
                btnConfirmarTexto.textContent = 'Procesando...';
                btnConfirmarSpinner.classList.remove('d-none');

                try {
                    const response = await fetch('/carrito/comprar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            carrito: cart,
                            metodo_entrega: metodoEntrega,
                            direccion: direccion,
                            forma_pago: formaPago
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        localStorage.removeItem('carrito');
                        sessionStorage.setItem('compra_exitosa', 'true');
                        window.location.reload();
                    } else {
                        mostrarErrorToast(data.message || 'Hubo un problema al procesar tu compra.');
                    }
                } catch (error) {
                    console.error(error);
                    mostrarErrorToast('Ocurrió un error inesperado al conectar con el servidor.');
                } finally {
                    btnConfirmar.disabled = false;
                    btnConfirmarTexto.textContent = 'Confirmar Pedido';
                    btnConfirmarSpinner.classList.add('d-none');
                }
            });
        }
    });
</script>
