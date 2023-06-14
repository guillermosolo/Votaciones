@auth
    <input type="hidden" name="mesa" value="{{$mesa}}">
    <input type="hidden" name="centro" value="{{$centroVotacion}}">
    <input type="hidden" name="boleta" value="A">
    <input type="hidden" name="fiscal" value="{{$fiscal}}">
    <div class="row">
        <div class="card col-md-6">
            <div class="card-body">
                <table class="table table-striped  table-hover" id="tabla-data">
                    <thead class='thead-dark'>
                        <tr>
                            <th></th>
                            <th>Partido</th>
                            <th>Votos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $data)
                            <tr>
                                <td><img src="{{ asset("assets/img/$data->partido_id.png") }}" loading="lazy"
                                        alt="{{ $data->partido->siglas }}" class="img-sm"></td>
                                <td style="vertical-align: middle;">{{ $data->partido->siglas }}</td>
                                <td style="vertical-align: middle;"><input type="hidden" name="partido[]" id="partido[]"
                                        value="{{ $data->partido_id }}">
                                    <input type="number" inputmode="numeric" class="form-control"
                                        name="votos[{{ $key }}]" id="votos[{{ $key }}]"
                                        value="{{ old('votos.' . $key, $data->cantidad) }}" min="0" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card sticky-top">
                <div class="card-body">
                    @foreach ($imagenes as $imagen)
                                <img src="{{ asset("actas/$imagen") }}" class="img-fluid"></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endauth
