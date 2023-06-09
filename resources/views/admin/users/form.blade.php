<div class="form-group row">
    <label for="name" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="name" class="form-control" id="name" placeholder="Nombre"
            value="{{old('name', $data->name ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="username" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre de Usuario</label>
    <div class="col-lg-8">
        <input type="text" name="username" class="form-control" id="username" placeholder="Nombre de Usuario"
            value="{{old('username', $data->username ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Correo Electrónico</label>
    <div class="col-lg-8">
        <input type="email" name="email" class="form-control" id="email" placeholder="Correo Electrónico"
            value="{{old('email', $data->email ?? '')}}">
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Contraseña</label>
    <div class="col-lg-8">
        <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" value="{{old('password','********' ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="tipo" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Rol</label>
    <div class="col-lg-8">
        <select name="tipo" id="tipo" class="form-control select2" placeholder="Rol">
            <option value="1" {{old('tipo',$data->tipo ?? '')==1 ? 'selected':''}}>Administrador</option>
            <option value="2" {{old('tipo',$data->tipo ?? '')==2 ? 'selected':''}}>Fiscal</option>
            <option value="3" {{old('tipo',$data->tipo ?? '')==3 ? 'selected':''}}>Supervisor</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="centro_id" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Centro de Votación</label>
    <div class="col-lg-8">
        <select name="centro_id" id="centro_id" class="form-control select2" placeholder="Centro de Votación">
            <option value =""> Seleccionar... </option>
            @foreach ($centro->getCentros() as $item)
            <option value="{{$item->id}}"
                {{old('centro_id',$data->centro_id ?? '')==$item->id ? 'selected':''}}>
                {{$item->nombre}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="mesa" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Mesa No.</label>
    <div class="col-lg-8">
        <input type="number" min="0" name="mesa" class="form-control" id="mesa" placeholder="Junta Receptora de Votos"
            value="{{old('mesa', $data->mesa ?? '')}}">
    </div>
</div>

