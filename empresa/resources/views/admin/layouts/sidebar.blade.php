<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-building"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Empresa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestión
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->is('dashboard/users*') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/users">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span>
        </a>
    </li>

    <!-- Nav Item - Dispositivos -->
    <li class="nav-item {{ request()->is('dashboard/dispositivos*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dispositivos.index') }}">
            <i class="fas fa-fw fa-mobile-alt"></i>
            <span>Dispositivos</span>
        </a>
    </li>

    <!-- Nav Item - Asignaciones -->
    <li class="nav-item {{ request()->is('dashboard/asignaciones*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('asignaciones.index') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>Asignaciones</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->