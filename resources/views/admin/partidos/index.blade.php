@extends("theme.$theme.layout")

@section("titulo")
Partidos Políticos y Comités Cívicos
@endsection

@section('aside')
    @include('admin.partidos.aside')
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
                        <h3 class="card-title">Listado de Partidos Políticos y Comités Cívicos<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('partidos.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped  table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Id</th>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Siglas</th>
                                    <th>Orden Presidente</th>
                                    <th>Orden Alcalde</th>
                                    <th>Orden Diputado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td><img src="{{asset("assets/img/$data->id.png")}}" loading="lazy" alt="{{$data->siglas}}" class="img-md"></td>
                                    <td>{{$data->nombre}}</td>
                                    <td>{{$data->siglas}}</td>
                                    <td>{{$data->presidente}}</td>
                                    <td>{{$data->alcalde}}</td>
                                    <td>{{$data->diputado}}</td>
                                    <td>
                                        <a href="{{route('partidos.editar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        <a href="{{route('partidos.eliminar',['id'=> $data->id])}}"
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
