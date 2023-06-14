@auth
@if (Auth::user()->tipo != 2 || (isset(Auth::user()->centroVotaciones->first()->id) && isset(Auth::user()->mesa)))
<button type="reset" class="btn btn-lg btn-outline-secondary">Cancelar</button>
<button type="submit" class="btn btn-lg btn-outline-success float-right">Guardar</button>
@endif
@endauth

