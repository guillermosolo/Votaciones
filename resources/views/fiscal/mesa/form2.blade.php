<div class="form-group row">
    <label for="fiscal" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Fiscal</label>
    <div class="col-lg-5">
        <input class="form-control" type="text" name="fiscal" value="{{ auth()->user()->name }}" readonly>
    </div>
    <label for="mesa" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Mesa No.</label>
    <div class="col-lg-2">
        <input class="form-control" type="text" name="mesa" value="{{ auth()->user()->mesa }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="centro" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Centro de Votación</label>
    <div class="col-lg-2">
        <input class="form-control" type="text" name="centro" value="{{auth()->user()->centroVotaciones->first()->id}}" readonly>
    </div>
    <div class="col-lg-6">
        <input class="form-control" type="text" name="centroNombre" value="{{ auth()->user()->centroVotaciones->first()->nombre }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="images" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Fotografías del
        Acta de Boletas de Presidente</label>
    <div class="col-lg-4">
        <input class="form-control-file" type="file" name="imagesPres[]" id="imagesPres" accept="image/*" multiple required>
    </div>
</div>
<div class="form-group row">
    <label for="images" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Fotografías del
        Acta de Boletas de Diputado</label>
    <div class="col-lg-4">
        <input class="form-control-file" type="file" name="imagesDip[]" id="imagesDip" accept="image/*" multiple required>
    </div>
</div>
<div class="form-group row">
    <label for="images" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Fotografías del
        Acta de Boletas de Alcalde</label>
    <div class="col-lg-4">
        <input class="form-control-file" type="file" name="imagesAl[]" id="imagesAl" accept="image/*" multiple required>
    </div>
</div>
