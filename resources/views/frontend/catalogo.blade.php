<x-layout title="Menú">
    <h1 class="mb-4 text-center"><span class="bg-blur p-2">Nuestro Menú</span></h1>

    <!-- Filtros -->
    <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
        <a href="/catalogo?categoria=todos" class="btn {{ $categoria === 'todos' ? 'btn-marron' : 'btn-marron' }}">
            Todos
        </a>
        <a href="/catalogo?categoria=hamburguesas"
            class="btn {{ $categoria === 'hamburguesas' ? 'btn-marron' : 'btn-marron' }}">
            Hamburguesas
        </a>
        <a href="/catalogo?categoria=empanadas"
            class="btn {{ $categoria === 'empanadas' ? 'btn-marron' : 'btn-marron' }}">
            Empanadas
        </a>
        <a href="/catalogo?categoria=papas" class="btn {{ $categoria === 'papas' ? 'btn-marron' : 'btn-marron' }}">
            Papas Fritas
        </a>
        <a href="/catalogo?categoria=bebidas" class="btn {{ $categoria === 'bebidas' ? 'btn-marron' : 'btn-marron' }}">
            Bebidas
        </a>
        <a href="/catalogo?categoria=combos" class="btn {{ $categoria === 'combos' ? 'btn-marron' : 'btn-marron' }}">
            Combos
        </a>
    </div>

    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card-producto">
                    <div class="position-relative">
                        <img src="{{ asset('img/' . $producto['imagen']) }}" class="card-img"
                            alt="{{ $producto['nombre'] }}">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="categoria">{{ $producto['categoria_nombre'] }}</span>
                        </div>
                        <h3 class="titulo">{{ $producto['nombre'] }}</h3>
                        <p class="descripcion">{{ $producto['descripcion'] }}</p>
                        <div class="card-footer-custom">
                            <span class="precio">${{ $producto['precio'] }}</span>
                            <button class="btn-agregar" data-id="{{ $producto['id'] }}"
                                data-nombre="{{ $producto['nombre'] }}" data-precio="{{ $producto['precio'] }}"
                                data-imagen="{{ $producto['imagen'] }}">
                                + Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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
    </style>
</x-layout>
