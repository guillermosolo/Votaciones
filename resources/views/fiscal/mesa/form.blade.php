@auth
    @if (isset(auth()->user()->centroVotaciones->first()->id) && isset(auth()->user()->mesa))
        <input type="hidden" name="mesa" value="{{ auth()->user()->mesa }}">
        <input type="hidden" name="centro" value="{{auth()->user()->centroVotaciones->first()->id}}">
        <table class="table table-striped  table-hover" id="tabla-data">
            <tbody>
                <td>Cantidad de papeletas recibidas:</td>
                <td><input type="number" class="form-control" name="papeletas" id="papeletas" min="0" required></td>
            </tbody>
        </table>
    @else
        <div class="alert alert-danger" role="alert">
            @if (!isset(auth()->user()->centroVotaciones->first()->id))
                Usted no tiene ningun centro de votación asignado, <strong>contacte al administrador.</strong>
            @else
                Usted no tiene ninguna mesa asignada, <strong>contacte al administrador.</strong>
            @endif
        </div>
    @endif
@endauth
