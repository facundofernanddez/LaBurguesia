<x-layout title="Dashboard Admin">
    <style>
        #dashboardTabs .nav-link {
            transition: all 0.3s ease;
            border-radius: 8px;
        }
        #dashboardTabs .nav-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff !important;
        }
        #dashboardTabs .nav-link.active {
            background: linear-gradient(135deg, var(--rojo) 0%, #b51e00 100%);
            box-shadow: 0 4px 12px rgba(214, 35, 0, 0.35);
        }
        .dashboard-section {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
        }
        .dashboard-section.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="bg-blur p-4 shadow-sm text-center">
                    <h1 class="fw-bold mb-2">Dashboard administrativo</h1>
                    <p class="text-muted mb-0">Resumen del negocio y gestión de productos.</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif



        <!-- Dashboard Navigation Navbar -->
        <div class="card shadow-sm border-0 mb-4 bg-marron">
            <div class="card-body p-2">
                <ul class="nav nav-pills nav-fill" id="dashboardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white fw-bold py-2" id="productos-tab" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-box-seam me-2"></i>Productos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white fw-bold py-2" id="categorias-tab" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-tags me-2"></i>Categorías
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white fw-bold py-2" id="usuarios-tab" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-people me-2"></i>Usuarios
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white fw-bold py-2" id="ventas-tab" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-receipt me-2"></i>Ventas
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-white fw-bold py-2" id="consultas-tab" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-envelope me-2"></i>Consultas
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Tab Contents -->
        <div id="dashboardTabContent">
            <!-- Sección Productos -->
            <div class="dashboard-section" id="section-productos">
                @include('backend.admin.components.gestion-productos')
            </div>

            <!-- Sección Categorías -->
            <div class="dashboard-section" id="section-categorias">
                @include('backend.admin.components.gestion-categorias')
            </div>

            <!-- Sección Usuarios -->
            <div class="dashboard-section" id="section-usuarios">
                @include('backend.admin.components.lista-usuarios')
            </div>

            <!-- Sección Ventas -->
            <div class="dashboard-section" id="section-ventas">
                @include('backend.admin.components.registro-ventas')
            </div>

            <!-- Sección Consultas -->
            <div class="dashboard-section" id="section-consultas">
                @include('backend.admin.components.consultas-contacto')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('#dashboardTabs button[role="tab"]');
            const tabContents = document.querySelectorAll('#dashboardTabContent .dashboard-section');

            function switchTab(tabId) {
                tabButtons.forEach(btn => {
                    if (btn.id === tabId) {
                        btn.classList.add('active');
                        btn.setAttribute('aria-selected', 'true');
                    } else {
                        btn.classList.remove('active');
                        btn.setAttribute('aria-selected', 'false');
                    }
                });

                const targetSectionId = tabId.replace('-tab', '');
                tabContents.forEach(pane => {
                    if (pane.id === 'section-' + targetSectionId) {
                        pane.classList.add('active');
                    } else {
                        pane.classList.remove('active');
                    }
                });
                
                // Save active tab to localStorage
                localStorage.setItem('activeDashboardTab', targetSectionId);
            }

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    switchTab(this.id);
                    const targetHash = this.id.replace('-tab', '');
                    history.replaceState(null, null, '#' + targetHash);
                });
            });

            // Determine active tab on load
            const hash = window.location.hash;
            const urlParams = new URLSearchParams(window.location.search);
            
            let activeTabId = null;
            
            // 1. Check query parameters first (high priority)
            if (urlParams.has('edit_producto')) {
                activeTabId = 'productos-tab';
            } else if (urlParams.has('edit_categoria')) {
                activeTabId = 'categorias-tab';
            } else if (urlParams.has('filtrar_usuario') || urlParams.has('filtrar_producto') || urlParams.has('filtrar_fecha_desde') || urlParams.has('filtrar_fecha_hasta')) {
                activeTabId = 'ventas-tab';
            } 
            // 2. Check URL Hash
            else if (hash) {
                const targetId = hash.replace('#', '') + '-tab';
                if (document.getElementById(targetId)) {
                    activeTabId = targetId;
                }
            } 
            // 3. Check localStorage
            else {
                const savedTab = localStorage.getItem('activeDashboardTab');
                if (savedTab && document.getElementById(savedTab + '-tab')) {
                    activeTabId = savedTab + '-tab';
                }
            }

            // Default to products tab if none matches
            if (!activeTabId) {
                activeTabId = 'productos-tab';
            }

            switchTab(activeTabId);
        });
    </script>
</x-layout>
