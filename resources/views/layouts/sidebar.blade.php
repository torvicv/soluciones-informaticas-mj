<div class="collapse collapse-horizontal p-2 flex-column" id="collapseWidthExample">
    <div class="sidebar-header border-bottom border-white mb-2 text-center">
        <a class="sidebar-brand text-decoration-none fs-5">PRUEBA TÉCNICA</a>
    </div>
    <div class="sidebar-header border-bottom border-white mb-2">
        <a class="sidebar-brand text-decoration-none">SOLUCIONES INFORMÁTICAS LJ</a>
    </div>
    <div class="sidebar-header border-bottom border-white mb-2">
        <a class="sidebar-brand text-decoration-none ms-2">MENU</a>
    </div>
    <div class="sidebar-nav ms-2">
        <div class="sidenav gap-6">
            <a class="sidebar-item">
                <div class="sidebar-item-content w-100">
                    <x-nav-link :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        class="text-decoration-none w-100 d-flex gap-3 {{request()->routeIs('dashboard') ? 'isActive' : ''}}">
                        <i class="bi bi-house-door-fill"></i> {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </a>
            <a class="sidebar-item">
                <div class="sidebar-item-content">
                    <x-nav-link :href="route('dias-festivos.index')"
                        class="text-decoration-none w-100 d-flex gap-3 {{request()->routeIs('dias-festivos.index') ? 'isActive' : ''}}">
                        <i class="bi bi-calendar-week-fill"></i> {{ __('Días Festivos') }}
                    </x-nav-link>
                </div>
            </a>
            <a class="sidebar-item">
                <div class="sidebar-item-content">
                    <x-nav-link :href="route('dashboard')"
                        class="text-decoration-none w-100 d-flex gap-3 {{request()->routeIs('dashboard') ? 'isActive' : ''}}">
                        <i class="bi bi-people"></i> {{ __('Usuarios') }}
                    </x-nav-link>
                </div>
            </a>
        </div>
    </div>
</div>
