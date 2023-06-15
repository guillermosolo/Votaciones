@auth
    <input type="hidden" name="mesa" value="{{$mesa}}">
    <input type="hidden" name="centro" value="{{$centroVotacion}}">
    <input type="hidden" name="boleta" value="I">
    <input type="hidden" name="fiscal" value="{{$fiscal}}">
    <div class="row">
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
