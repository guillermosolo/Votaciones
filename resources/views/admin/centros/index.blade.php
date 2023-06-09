@extends("theme.$theme.layout")

@section("titulo")
Centros de Votación
@endsection

@section('aside')
    @include('admin.centros.aside')
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
                        <h3 class="card-title">Listado de Centros de Votación<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('centros.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped  table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Area</th>
                                    <th>Empadronados</th>
                                    <th>Juntas Receptoras</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->nombre}}</td>
                                    <td>{{$data->sector=='U' ? 'URBANO':'RURAL'}}</td>
                                    <td>{{$data->empadronados}}</td>
                                    <td>{{$data->JRV}}</td>
                                    <td>
                                        <a href="{{route('centros.editar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        <a href="{{route('centros.eliminar',['id'=> $data->id])}}"
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
