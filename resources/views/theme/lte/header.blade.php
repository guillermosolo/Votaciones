<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-lg"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="row">
                <div class="col-sm-1">
                    <img src="{{ asset("assets/$theme/dist/img/noimage.svg") }}" class="img-size-50  user-image">
                </div>
                <div class="col-sm-10">
                    <span class="ml-2 mr-5 text-sm">{{ auth()->user()->name }}</span>
                </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" role="button" data-toggle="tooltip"
                title="Salir del Sistema"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-lg"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
