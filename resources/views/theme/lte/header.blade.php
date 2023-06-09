<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <img src="{{asset("assets/$theme/dist/img/noimage.svg")}}" class="img-size-50  user-image">
       <!-- <span class="mr-5">{{session()->get('name') ?? 'Invitado'}}</span> -->
        <span class="mr-5">{{auth()->user()->name}}</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('logout')}}" role="button" data-toggle="tooltip" title="Salir del Sistema"
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
