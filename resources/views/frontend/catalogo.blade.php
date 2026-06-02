<x-layout title="Menú">
    <h1 class="mb-4 text-center"><span class="bg-blur p-2">Nuestro Menú</span></h1>

    @if ($productos->isEmpty() && $categoria === 'todos')
        <div class="alert alert-warning text-center py-5 shadow-sm rounded-4 mt-4">
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
                    <div class="card-producto">
                        <div class="position-relative">
                            <img src="{{ asset($producto->imagen ? 'img/' . $producto->imagen : 'img/logo.png') }}" class="card-img"
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
                                @if ($producto->stock > 0)
                                    <button class="btn-agregar" data-id="{{ $producto->id }}"
                                        data-nombre="{{ $producto->nombre }}" data-precio="{{ $producto->precio }}"
                                        data-imagen="{{ $producto->imagen }}">
                                        + Agregar
                                    </button>
                                @else
                                    <span class="badge bg-danger position-static">Sin Stock</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">No hay productos disponibles en esta categoría.</p>
                </div>
            @endforelse

            <script>
                document.querySelectorAll('.btn-agregar').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const producto = {
                            id: this.dataset.id,
                            nombre: this.dataset.nombre,
                            precio: parseInt(this.dataset.precio),
                            imagen: this.dataset.imagen,
                            cantidad: 1
                        };

                        let cart = JSON.parse(localStorage.getItem('carrito')) || [];
                        cart.push(producto);
                        localStorage.setItem('carrito', JSON.stringify(cart));

                        const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasCart'));
                        offcanvas.show();
                    });
                });
            </script>

        </div>
    @endif

    <style>
        .card-producto {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background: #fff;
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
