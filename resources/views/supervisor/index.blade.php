@extends("theme.$theme.layout2")

@section('styles')
    <style>
        .text-light-pink {
            color: #EC407A;
            /* Reemplaza este valor con el color rosa más claro que desees */
        }

        .text-light-sky {
            color: #1565C0;
            /* Reemplaza este valor con el color rosa más claro que desees */
        }

        .disabled {
            color: currentColor;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
            pointer-events: none;
        }
    </style>
@endsection

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card">
                    <div class="card-header">{{ __('Supervisor') }}</div>
                    <div class="card-body">
                        <table class="table table-striped  table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    <th>Centro Votación</th>
                                    <th>Mesa</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->centroVotaciones->first()->nombre }}</td>
                                        <td>{{ $data->mesa }}</td>
                                        <td>
                                            <a href="{{ route('validarPresi', ['centroVotacion' => $data->centroVotaciones->first()->id, 'mesa' => $data->mesa, 'fiscal' => $data->id]) }}"
                                                class="btn-accion-tabla mr-4 @if ($data->mesaValidadaPres || $data->mesaImpugnada) disabled @endif"
                                                data-toggle="tooltip" title="Presidente">
                                                <i class="text-dark far fa-file-alt"></i></a>
                                            <a href="{{ route('validarDip', ['centroVotacion' => $data->centroVotaciones->first()->id, 'mesa' => $data->mesa, 'fiscal' => $data->id]) }}"
                                                class="btn-accion-tabla mr-4 @if ($data->mesaValidadaDip || $data->mesaImpugnada) disabled @endif"
                                                data-toggle="tooltip" title="Diputado">
                                                <i class="text-light-sky fas fa-file-alt"></i></a>
                                            <a href="{{ route('validarAl', ['centroVotacion' => $data->centroVotaciones->first()->id, 'mesa' => $data->mesa, 'fiscal' => $data->id]) }}"
                                                class="btn-accion-tabla mr-4 @if ($data->mesaValidadaAl || $data->mesaImpugnada) disabled @endif"
                                                data-toggle="tooltip" title="Alcalde">
                                                <i class="text-light-pink fas fa-file-alt"></i></a>
                                            <a href="{{ route('validarImp', ['centroVotacion' => $data->centroVotaciones->first()->id, 'mesa' => $data->mesa, 'fiscal' => $data->id]) }}"
                                                class="btn-accion-tabla mr-4 @if (!$data->mesaImpugnada) disabled @endif"
                                                data-toggle="tooltip" title="Alcalde">
                                                <i class="text-warning fas fa-file-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
