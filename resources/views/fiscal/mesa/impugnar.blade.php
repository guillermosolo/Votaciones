@extends("theme.$theme.layout2")
@section("titulo")
Cerrar Mesa
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            @include('includes.mensaje')
            @include('includes.form-error')
            <div class="card card-outline card-dark">
                <div class="card-header">
                    <h3 class="card-title">Impugnación de Mesa<small></small></h3>
                <div class="card-tools">
                    <a href="{{route('menuFiscal')}}" class="btn btn-block btn-info btn-sm">
                        Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                </div>
            </div>
                <form action="{{route('mesa.guardarImpugnacion')}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @include('fiscal.mesa.form3')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-4 d-sm-none d-lg-block"></div>
                        <div class="col-lg-4">
                            @include('includes.boton-form-crear')
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
