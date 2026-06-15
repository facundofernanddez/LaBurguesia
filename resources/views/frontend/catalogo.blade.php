<x-layout title="Menú">
    <h1 class="mb-4 text-center"><span class="bg-blur p-2">Nuestro Menú</span></h1>

    @if ($productos->isEmpty() && $categoria === 'todos')
        <div class="alert alert-warning text-center py-5 shadow-sm rounded-4 mt-4 bg-blur">
            <h3 class="fw-bold mb-2">🍔 Catálogo vacío</h3>
            <p class="text-muted mb-0">No hay productos cargados en el catálogo actualmente. Vuelve más tarde.</p>
        </div>
    @else
        <!-- Filtros -->
        <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
            <a href="/catalogo?categoria=todos" class="btn btn-marron">
                <span class="{{ $categoria === 'todos' ? 'texto-activo' : '' }}">Todos</span>
            </a>
            @foreach ($categorias as $cat)
                <a href="/catalogo?categoria={{ $cat->nombre }}" class="btn btn-marron">
                    <span class="{{ $categoria === $cat->nombre ? 'texto-activo' : '' }}">{{ ucfirst($cat->nombre) }}</span>
                </a>
            @endforeach
        </div>

        <div class="row">
            @forelse ($productos as $producto)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-producto" data-id="{{ $producto->id }}">
                        <div class="position-relative">
                            @if ($producto->destacado)
                                <span class="badge badge-destacado"><i class="bi bi-star-fill me-1"></i>Destacado</span>
                            @endif
                            <img src="{{ asset($producto->imagen ? 'img/producto/' . $producto->imagen : 'img/logo.png') }}" class="card-img"
                                alt="{{ $producto->nombre }}">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="categoria">{{ ucfirst($producto->categoria) }}</span>
                            </div>
                            <h3 class="titulo">{{ $producto->nombre }}</h3>
                            <p class="descripcion">{{ $producto->descripcion }}</p>

                            <div class="card-footer-custom">
                                <span class="precio">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                
                                <!-- Contenedor de acción dinámica de stock -->
                                <div class="action-container" 
                                     data-id="{{ $producto->id }}" 
                                     data-stock="{{ $producto->stock }}" 
                                     data-nombre="{{ $producto->nombre }}" 
                                     data-precio="{{ $producto->precio }}" 
                                     data-imagen="{{ $producto->imagen }}">
                                    @if (Auth::user()?->rol?->nombre === 'admin')
                                        {{-- El admin no puede realizar compras --}}
                                    @elseif ($producto->stock > 0)
                                        <button class="btn-agregar" data-id="{{ $producto->id }}"
                                            data-nombre="{{ $producto->nombre }}" data-precio="{{ $producto->precio }}"
                                            data-imagen="{{ $producto->imagen }}" data-stock="{{ $producto->stock }}">
                                            + Agregar
                                        </button>
                                    @else
                                        <span class="badge bg-danger position-static">Sin Stock</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 bg-blur">
                    <p class="text-muted fs-5">No hay productos disponibles en esta categoría.</p>
                </div>
            @endforelse

            <script>
                const isAdmin = {{ Auth::user()?->rol?->nombre === 'admin' ? 'true' : 'false' }};

                // Función para sincronizar la UI del catálogo con el carrito de localStorage
                function syncCatalogStock() {
                    if (isAdmin) {
                        document.querySelectorAll('.action-container').forEach(container => {
                            container.innerHTML = '';
                        });
                        return;
                    }
                    const cart = JSON.parse(localStorage.getItem('carrito')) || [];
                    
                    document.querySelectorAll('.action-container').forEach(container => {
                        const id = container.dataset.id;
                        const stock = parseInt(container.dataset.stock);
                        const nombre = container.dataset.nombre;
                        const precio = container.dataset.precio;
                        const imagen = container.dataset.imagen;
                        
                        // Buscar la cantidad de este producto ya agregada en el carrito
                        const cartItem = cart.find(item => item.id == id);
                        const cantidadInCart = cartItem ? cartItem.cantidad : 0;
                        const remainingStock = stock - cantidadInCart;
                        
                        // Actualizar número de stock disponible en la tarjeta
                        const stockDisplay = document.querySelector(`.stock-display[data-id="${id}"]`);
                        if (stockDisplay) {
                            stockDisplay.textContent = remainingStock;
                            if (remainingStock <= 0) {
                                stockDisplay.classList.remove('text-success');
                                stockDisplay.classList.add('text-danger');
                            } else {
                                stockDisplay.classList.remove('text-danger');
                                stockDisplay.classList.add('text-success');
                            }
                        }
                        
                        // Cambiar botón / badge de Sin Stock
                        if (remainingStock <= 0) {
                            container.innerHTML = `<span class="badge bg-danger position-static">Sin Stock</span>`;
                        } else {
                            container.innerHTML = `
                                <button class="btn-agregar" data-id="${id}"
                                    data-nombre="${nombre}" data-precio="${precio}"
                                    data-imagen="${imagen}" data-stock="${stock}">
                                    + Agregar
                                </button>
                            `;
                        }
                    });
                    
                    // Como re-creamos los botones en el HTML, debemos re-vincular los eventos
                    attachAddEventListeners();
                }

                // Vincula los eventos de click en los botones "+ Agregar"
                function attachAddEventListeners() {
                    document.querySelectorAll('.btn-agregar').forEach(btn => {
                        // Evita duplicar listeners clonando el botón
                        const newBtn = btn.cloneNode(true);
                        btn.parentNode.replaceChild(newBtn, btn);
                        
                        newBtn.addEventListener('click', function() {
                            const id = this.dataset.id;
                            const nombre = this.dataset.nombre;
                            const precio = parseInt(this.dataset.precio);
                            const imagen = this.dataset.imagen;
                            const stock = parseInt(this.dataset.stock);
                            
                            let cart = JSON.parse(localStorage.getItem('carrito')) || [];
                            
                            // Buscar si ya está en el carrito
                            let cartItem = cart.find(item => item.id == id);
                            
                            if (cartItem) {
                                if (cartItem.cantidad >= stock) {
                                    alert('No hay más stock disponible para este producto.');
                                    return;
                                }
                                cartItem.cantidad += 1;
                            } else {
                                cart.push({
                                    id: id,
                                    nombre: nombre,
                                    precio: precio,
                                    imagen: imagen,
                                    stock: stock,
                                    cantidad: 1
                                });
                            }
                            
                            localStorage.setItem('carrito', JSON.stringify(cart));
                            
                            // Disparar el evento global de actualización
                            window.dispatchEvent(new CustomEvent('cart-updated'));
                            
                            // Abrir el sidebar/canvas del carrito
                            const offcanvasEl = document.getElementById('offcanvasCart');
                            if (offcanvasEl) {
                                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl) || new bootstrap.Offcanvas(offcanvasEl);
                                offcanvas.show();
                            }
                        });
                    });
                }

                // Inicializar
                document.addEventListener('DOMContentLoaded', function() {
                    syncCatalogStock();
                    
                    // Escuchar actualizaciones externas del carrito (ej: cambios o eliminación en el canvas)
                    window.addEventListener('cart-updated', syncCatalogStock);

                    // Resaltar y hacer scroll al producto seleccionado desde el home
                    const urlParams = new URLSearchParams(window.location.search);
                    const highlightId = urlParams.get('producto');
                    if (highlightId) {
                        const targetCard = document.querySelector(`.card-producto[data-id="${highlightId}"]`);
                        if (targetCard) {
                            // Primero scrolleamos suavemente hacia la tarjeta
                            setTimeout(() => {
                                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }, 150);

                            // Agregamos la clase de animación cuando el scroll esté finalizando (aprox. 850ms de delay)
                            setTimeout(() => {
                                targetCard.classList.add('highlight-product');
                            }, 850);
                        }
                    }
                });
            </script>

        </div>
    @endif

    <style>
        .card-producto {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
            background: #fff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-producto:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        @keyframes highlightGlow {
            0% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
            }
            30% {
                transform: scale(1.04);
                box-shadow: 0 0 20px rgba(214, 35, 0, 0.4);
            }
            70% {
                transform: scale(1.04);
                box-shadow: 0 0 20px rgba(214, 35, 0, 0.4);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
            }
        }

        .highlight-product {
            animation: highlightGlow 1.5s ease-in-out;
        }

        .badge {
            position: absolute;
            top: 15px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-popular {
            left: 15px;
            background: #D62300;
            color: white;
        }

        .badge-destacado {
            left: 15px;
            background: #FFC72C;
            color: #502314;
            box-shadow: 0 4px 10px rgba(255, 199, 44, 0.3);
            border: 1px solid rgba(80, 35, 20, 0.1);
        }

        .badge-oferta {
            left: 15px;
            background: #7C3AED;
            color: white;
        }

        .badge-nuevo {
            left: 15px;
            background: #16A34A;
            color: white;
        }

        .badge-kcal {
            right: 15px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .card-body {
            padding: 20px;
        }

        .categoria {
            background: #f3f3f3;
            color: #D62300;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .rating {
            color: #f59e0b;
            font-size: 14px;
        }

        .titulo {
            font-size: 20px;
            font-weight: 600;
            margin: 10px 0;
            color: #502314;
        }

        .descripcion {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }

        .card-footer-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .precio {
            color: #D62300;
            font-size: 20px;
            font-weight: bold;
        }

        .btn-agregar {
            background: #D62300;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-agregar:hover {
            background: #a91b00;
        }

        .texto-activo {
            color: #D62300;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</x-layout>
