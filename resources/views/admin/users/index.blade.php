@extends("theme.$theme.layout")

@section("titulo")
Usuarios
@endsection

@section('aside')
    @include('admin.users.aside')
@endsection

@section('contenido')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Usuarios<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('usuarios.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped  table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Centro de Votación</th>
                                    <th>Junta Receptora</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->rol}}</td>
                                    <td>
                                        @if($data->centroVotaciones->isNotEmpty())
                                           {!! nl2br(implode("\n", $data->centroVotaciones->pluck('nombre')->toArray())) !!}
                                        @else
                                            ----
                                        @endif
                                    </td>
                                    <td>{{$data->mesa??'--'}}</td>
                                    <td>
                                        <a href="{{route('usuarios.editar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        <a href="{{route('usuarios.eliminar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla eliminar-registro mr-4" data-toggle="tooltip"
                                            title="Eliminar este registro">
                                            <i class="text-danger far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
