<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
      <div class="sidebar-brand-icon">
        <i class="fas fa-user"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SB Admin</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item {{Route::currentRouteNamed('home') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->


    
    <!-- Nav Item - archivo -->
    <li class="nav-item {{Route::currentRouteNamed('uploadfile') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('uploadfile') }}">
        <i class="fas fa-fw fa-file-excel"></i>
        <span>Cargar archivo</span></a>
    </li>

    
    <li class="nav-item {{Route::currentRouteNamed('calculardatos') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('calculardatos') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>Calcular Datos</span>
        </a>
    </li>

    <!-- Nav Item - filtros resumen demanda -->
    <li class="nav-item {{Route::currentRouteNamed('resumendemanda') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('resumendemanda') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Filtros Demanda</span></a>
    </li>

    <!-- Nav Item - filtros resumen pob servicios-->
    <li class="nav-item {{Route::currentRouteNamed('resumenservicios') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('resumenservicios') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Filtros POB C/S Servicios</span></a>
    </li>

    <!-- Nav Item - filtros resumen pob servicios-->
    <li class="nav-item {{Route::currentRouteNamed('resumenrango') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('resumenrango') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Filtros Rango</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->