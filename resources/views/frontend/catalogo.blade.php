<x-layout title="Menú">
  <h1 class="mb-4 text-center">Nuestro Menú</h1>
  
  <div class="row">
    <!-- Classic Burger -->
    <div class="col-lg-4 mb-4">
      <div class="card-producto">
        <div class="position-relative">
          <img src="{{ asset('img/hambur1.png') }}" class="card-img" alt="Classic Burger">
          <span class="badge badge-popular">Popular</span>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="categoria">Clásica</span>
            <span class="rating">★ 4.5</span>
          </div>
          <h3 class="titulo">Classic Burger</h3>
          <p class="descripcion">Hamburguesa clásica con lechuga, tomate y nuestra salsa secreta.</p>
          <div class="card-footer-custom">
            <span class="precio">$1.500</span>
            <button class="btn-agregar">+ Agregar</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Cheese Burger -->
    <div class="col-lg-4 mb-4">
      <div class="card-producto">
        <div class="position-relative">
          <img src="{{ asset('img/hambur2.png') }}" class="card-img" alt="Cheese Burger">
          <span class="badge badge-oferta">Oferta</span>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="categoria">Con Queso</span>
            <span class="rating">★ 4.8</span>
          </div>
          <h3 class="titulo">Cheese Burger</h3>
          <p class="descripcion">Con queso cheddar fundido y tocino crujiente.</p>
          <div class="card-footer-custom">
            <span class="precio">$1.800</span>
            <button class="btn-agregar">+ Agregar</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bacon Burger -->
    <div class="col-lg-4 mb-4">
      <div class="card-producto">
        <div class="position-relative">
          <img src="{{ asset('img/hambur3.png') }}" class="card-img" alt="Bacon Burger">
          <span class="badge badge-nuevo">Nuevo</span>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="categoria">Premium</span>
            <span class="rating">★ 4.9</span>
          </div>
          <h3 class="titulo">Bacon Burger</h3>
          <p class="descripcion">Doble porción de tocino y cebolla crispy.</p>
          <div class="card-footer-custom">
            <span class="precio">$2.000</span>
            <button class="btn-agregar">+ Agregar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <style>
    .card-producto {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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
      background: rgba(0,0,0,0.6);
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