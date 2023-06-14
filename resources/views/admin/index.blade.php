@extends("theme.$theme.layout")
@section('titulo')

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
@include('admin.chart')
@endsection

@section('aside')
  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">Votaciones</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" id="mprincipal" data-accordion="true">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">MENÚ PRINCIPAL</li>
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('usuarios')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('centros')}}" class="nav-link">
                    <i class="nav-icon fas fa-city"></i>
                    <p>Centros de Votación</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('partidos')}}" class="nav-link">
                    <i class="nav-icon fas fa-shield-alt"></i>
                    <p>Partidos</p>
                </a>
            </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
@endsection

@section('contenido')
<section class="content">
    <div class="container-fluid">
            @include('admin.dashboard')
    </div>
</section>
@endsection
