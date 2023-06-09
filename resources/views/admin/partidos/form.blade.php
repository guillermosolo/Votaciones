<div class="form-group row">
    <label for="nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre"
            value="{{old('nombre', $data->nombre ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="siglas" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Siglas</label>
    <div class="col-lg-8">
        <input type="text" name="siglas" class="form-control" id="siglas" placeholder="Siglas"
            value="{{old('siglas', $data->siglas ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="presidente" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Presidente</label>
    <div class="col-lg-2">
        <input type="number" name="presidente" class="form-control" id="presidente" placeholder="Presidente"
            value="{{old('presidente', $data->presidente ?? '')}}" required>
    </div>
    <label for="alcalde" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Alcalde</label>
    <div class="col-lg-2">
        <input type="number" name="alcalde" class="form-control" id="alcalde" placeholder="Alcalde"
            value="{{old('alcalde', $data->alcalde ?? '')}}" required>
    </div>
    <label for="diputado" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Diputados</label>
    <div class="col-lg-2">
        <input type="number" name="diputado" class="form-control" id="diputado" placeholder="Diputados"
            value="{{old('diputado', $data->diputado ?? '')}}" required>
    </div>
</div>

