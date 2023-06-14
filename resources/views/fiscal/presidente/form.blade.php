@auth
@if (isset(auth()->user()->centroVotaciones->first()->id) && isset(auth()->user()->mesa))
<input type="hidden" name="mesa" value="{{auth()->user()->mesa}}">
<input type="hidden" name="centro" value="{{auth()->user()->centroVotaciones->first()->id}}">
<input type="hidden" name="boleta" value="P">
<table class="table table-striped  table-hover" id="tabla-data">
    <thead class='thead-dark'>
        <tr>
            <th></th>
            <th>Partido</th>
            <th>Votos</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $key=> $data)
            <tr>
                <td><img src="{{asset("assets/img/$data->id.png")}}" loading="lazy" alt="{{$data->siglas}}" class="img-sm"></td>
                <td style="vertical-align: middle;">{{$data->siglas}}</td>
                <td style="vertical-align: middle;"><input type="hidden" name="partido[]" id="partido[]" value="{{$data->id}}">
                    <input type="number" inputmode="numeric" class="form-control" name="votos[{{$key}}]" id="votos[{{$key}}]" value="{{ old('votos.' . $key) }}" min="0"  required></td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-danger" role="alert">
    @if (!isset(auth()->user()->centro_id))
    Usted no tiene ningun centro de votación asignado, <strong>contacte al administrador.</strong>
    @else
    Usted no tiene ninguna mesa asignada, <strong>contacte al administrador.</strong>
    @endif
  </div>
@endif
@endauth
