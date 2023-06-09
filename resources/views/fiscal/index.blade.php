@extends("theme.$theme.layout2")

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            @include('includes.mensaje')
            @include('includes.form-error')
            <div class="card">
                <div class="card-header">{{ __('Fiscal') }}</div>
                <div class="card-body">
                    <a href="{{route('mesa')}}" type="button" class="btn btn-outline-success btn-lg btn-block d-block mb-3 @if(!is_null($usuario->papeletas)) disabled @endif">Aperturar Mesa</a>
                    <a href="{{route('presidente')}}" type="button" class="btn btn-outline-dark btn-lg btn-block d-block mb-3 @if(is_null($usuario->papeletas) || $usuario->mesaCerrada || $usuario->mesaImpugnada) disabled @endif" >Datos Boleta Presidente</a>
                    <a href="{{route('alcalde')}}" type="button" class="btn btn-outline-dark btn-lg btn-block d-block mb-3 @if(is_null($usuario->papeletas) || $usuario->mesaCerrada || $usuario->mesaImpugnada) disabled @endif">Datos Boleta Alcalde</a>
                    <a href="{{route('diputado')}}" type="button" class="btn btn-outline-dark btn-lg btn-block d-block mb-3 @if(is_null($usuario->papeletas) || $usuario->mesaCerrada || $usuario->mesaImpugnada) disabled @endif">Datos Boleta Diputados</a>
                    <a href="{{route('mesa.fotos')}}" type="button" class="btn btn-outline-info btn-lg btn-block d-block mb-3 @if(is_null($usuario->papeletas) || $usuario->mesaCerrada || $usuario->mesaImpugnada || !$usuario->todosDatos) disabled @endif">Cerrar Mesa</a>
                    <a href="#" type="button" class="btn btn-outline-warning btn-lg btn-block d-block mb-3 @if(is_null($usuario->papeletas) || $usuario->mesaCerrada) disabled @endif">Impugnar Mesa</a>
                    <a href="{{route('logout')}}" type="button" class="btn btn-outline-danger btn-lg btn-block d-block mb-3"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
