@extends("theme.$theme.layout")
@section("titulo")
Usuarios
@endsection

@section('styles')
<link href="{{asset("assets/$theme/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/$theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
@endsection


@section('scripts')
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/$theme/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/$theme/plugins/select2/js/i18n/es.js")}}"></script>
@endsection

@section('aside')
    @include('admin.users.aside')
@endsection

@section('contenido')
@inject('centro', 'App\Models\CentroVotacion')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Editar Usuario: {{$data->username}} <small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('usuarios')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('usuarios.actualizar',['id'=>$data->id])}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('admin.users.form')
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    @include('includes.boton-form-editar')
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
