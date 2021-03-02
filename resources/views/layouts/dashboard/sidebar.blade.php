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

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
      Addons
    </div> -->

    
    <!-- Nav Item - archivo -->
    <li class="nav-item {{Route::currentRouteNamed('uploadfile') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('uploadfile') }}">
        <i class="fas fa-fw fa-file-excel"></i>
        <span>Cargar archivo</span></a>
    </li>

    <!-- Nav Item - datos -->
    <li class="nav-item {{Route::currentRouteNamed('verdatos') ? 'active' : ''}}">
      <!-- <a class="nav-link" href="{{ route('verdatos') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Datos</span></a> -->
        
    </li>

    <li class="nav-item {{Route::currentRouteNamed('calculardatos') ? 'active' : ''}}">
      <a class="nav-link collapsed" href="{{ route('calculardatos') }}" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Calcular Datos</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">AP:</h6>
              <a class="collapse-item" href="{{ route('calculardatos') }}">Demanda</a>
              <a class="collapse-item" href="{{ route('calculardatos') }}">Población</a>
              <a class="collapse-item" href="{{ route('calculardatos') }}">Cobertura</a>
              <div class="collapse-divider"></div>
              
          </div>
      </div>
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