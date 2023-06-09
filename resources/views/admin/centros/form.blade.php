<input type="hidden" value="1" name="municipio_id" id="municipio_id">
<input type="hidden" value="{{$ultimoID??$data->id}}" name="id" id="id">
<div class="form-group row">
    <label for="nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre"
            value="{{old('nombre', $data->nombre ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="JRV" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Juntas Receptoras de Votos</label>
    <div class="col-lg-3">
        <input type="number" name="JRV" class="form-control" id="JRV" placeholder="Juntas Receptoras de Votos"
            value="{{old('JRV', $data->JRV ?? '')}}" required>
    </div>
    <label for="empadronados" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cantidad de Empadronados</label>
    <div class="col-lg-3">
        <input type="number" name="empadronados" class="form-control" id="empadronados" placeholder="Empadronados"
            value="{{old('empadronados', $data->empadronados ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="sector" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Sector</label>
    <div class="col-lg-8">
        <select name="sector" id="sector" class="form-control select2" placeholder="Sector">
            <option value="U" {{old('tipo',$data->tipo ?? '')==1 ? 'selected':''}}>URBANO</option>
            <option value="R" {{old('tipo',$data->tipo ?? '')==2 ? 'selected':''}}>RURAL</option>
        </select>
    </div>
</div>

