@extends("theme.$theme.layout")
@section('titulo')
@endsection

@section('scriptPlugins')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
@endsection

@section('scripts')
    @include('admin.chart')
@endsection

@section('styles')
    <style>
        .chart-container {
            width: 100%;
            height: 80vh;
        }

        .cartas1 {
            width: 100%;
            height: 40vh;
        }

        .info-box-content {
            overflow: auto;
        }

        .info-box-text {
            word-wrap: break-word;
            font-size: 16px !important;
        }

        .info-box-number {
            font-size: 24px !important;
        }

        .info-box-num2 {
            font-size: 12px !important;
        }

        @media only screen and (max-width: 850px) and (orientation:portrait) {
            .chart-container {
                height: 40vh !important;
            }

            .cartas1 {
                height: 30vh !important;
            }
        }

        @media only screen and (max-height: 850px) and (orientation:portrait) {
            .chart-container {
                height: 20vh !important;
            }

            .cartas1 {
                height: 30vh !important;
            }
        }

        @media only screen and (max-height: 850px) and (orientation:landscape) {
            .chart-container {
                height: 60vh !important;
            }

            .cartas1 {
                height: 30vh !important;
            }
        }

        @media only screen and (max-height: 480px) and (orientation: landscape) {
            .chart-container {
                height: 90vh !important;
            }

            .cartas1 {
                height: 65vh !important;
            }
        }
    </style>
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
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    id="mprincipal" data-accordion="true">
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
                        <a href="{{ route('usuarios') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('centros') }}" class="nav-link">
                            <i class="nav-icon fas fa-city"></i>
                            <p>Centros de Votación</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('partidos') }}" class="nav-link">
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
