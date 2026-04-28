<x-layout title="Comercialización">
    {{-- Overlay que baja el ruido del fondo --}}
    <div class="bg-blur" style="padding: 3rem 0; min-height: 100vh;">

        {{-- 1. HEADER DE SECCIÓN --}}
        <div class="container mb-5">
            <h1 class="text-center" style="color: #502314; font-weight: 700; font-size: 3rem;">
                Comercialización
            </h1>
            <p class="text-center" style="color: #6b6b6b; font-size: 1.25rem; margin-top: 0.5rem;">
                Pedí tu hamburguesa favorita de forma rápida y segura
            </p>
        </div>

        {{-- 2. PROMOS DESTACADAS --}}
        <div class="container mb-5">
            <div class="promos-wrapper">
                <div class="promo-box">
                    🚀 <strong>Envío gratis</strong> en pedidos mayores a $10.000
                </div>
                <div class="promo-box">
                    🎉 <strong>Promos</strong> los martes y viernes
                </div>
            </div>
        </div>

        {{-- 3. GRID DE CARDS (4 columnas) --}}
        <div class="container">
            <div class="row g-4">

                {{-- CARD 1: Formas de Entrega --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="info-card h-100">
                        <div class="card-content">
                            <div class="icon-box">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h3 style="color: #D62300; font-weight: 600; margin-bottom: 1rem;">Formas de Entrega</h3>
                            <ul class="info-list">
                                <li>Delivery a domicilio</li>
                                <li>Takeaway en local</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: Métodos de Pago --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="info-card h-100">
                        <div class="card-content">
                            <div class="icon-box">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <h3 style="color: #D62300; font-weight: 600; margin-bottom: 1rem;">Métodos de Pago</h3>
                            <ul class="info-list">
                                <li>Efectivo</li>
                                <li>Transferencia bancaria</li>
                                <li>Mercado Pago</li>
                                <li>Tarjetas débito/crédito</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- CARD 3: Zonas de Retiro --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="info-card h-100">
                        <div class="card-content">
                            <div class="icon-box">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h3 style="color: #D62300; font-weight: 600; margin-bottom: 1rem;">Zonas de Retiro</h3>
                            <ul class="info-list">
                                <li>Bolivia 5421</li>
                                <li>Belgrano 1958</li>
                                <li>Junin 895</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- CARD 4: Tiempo de Entrega --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="info-card h-100">
                        <div class="card-content">
                            <div class="icon-box">
                                <i class="bi bi-clock"></i>
                            </div>
                            <h3 style="color: #D62300; font-weight: 600; margin-bottom: 1rem;">Tiempo de Entrega</h3>
                            <ul class="info-list">
                                <li>30 a 45 minutos</li>
                                <li style="font-size: 0.85rem; color: #666;">Dependiendo de la demanda</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- 4. BOTONES DE ACCIÓN --}}
        <div class="container mt-5">
            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center align-items-center">
                <a href="https://wa.me/3795343745" target="_blank" class="btn btn-whatsapp btn-pill">
                    <i class="bi bi-whatsapp me-2"></i>Pedir por WhatsApp
                </a>
            </div>
        </div>

        {{-- BONUS: Stats --}}
        <div class="container mt-5">
            <p class="text-center" style="color: #502314; font-weight: 600;">
                ⭐ Más de 50 clientes satisfechos por día
            </p>
        </div>

    </div>

    {{-- ESTILOS --}}
    <style>
        @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

        .promo-box {
            display: inline-block;
            background: linear-gradient(135deg, #D62300 0%, #8B1600 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(214, 35, 0, 0.3);
        }

        .promos-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }


        .info-card {
            background: #f5e9dc;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(80, 35, 20, 0.08);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(80, 35, 20, 0.15);
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #502314;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
        }

        .icon-box i {
            font-size: 1.75rem;
            color: #FFC72C;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
            width: 100%;
        }

        .info-list li {
            padding: 0.4rem 0;
            border-bottom: 1px solid rgba(80, 35, 20, 0.1);
            color: #502314;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .btn-pill {
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #D62300;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background: #8B1600;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(214, 35, 0, 0.4);
        }

        .btn-whatsapp {
            background: #25D366;
            border: none;
            color: white;
        }

        .btn-whatsapp:hover {
            background: #1da851;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem !important;
            }

            .promo-box {
                font-size: 0.9rem;
                padding: 0.75rem 1.25rem;
            }

            .d-flex.flex-wrap {
                flex-direction: column !important;
                align-items: center !important;
            }
        }
    </style>
</x-layout>
