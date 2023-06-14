@extends("theme.$theme.layout2")
@section('titulo')
    Alcalde
@endsection

@section('contenido')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Resultados Boleta Alcalde<small></small></h3>
                        <div class="card-tools">
                            <a href="{{ route('menuSuper', ['centroVotacion' => $centroVotacion]) }}"
                                class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('validar.guardar') }}" id="form-general" class="form-horizontal"
                        method="POST" autocomplete="off">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('supervisor.alcalde.form')
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    @include('includes.boton-form-validar')
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
