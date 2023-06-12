<div class="row mt-5">
    <div class="col-md-10">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Presidente</h5>
                    <canvas id="grafico-presidente"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Alcalde</h5>
                    <canvas id="grafico-alcalde"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Diputado</h5>
                    <canvas id="grafico-diputado"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <table style="border-collapse: collapse;">
            @foreach($partidosT as $dato)
            <tr>
                <td>
                    <div style="width: 10px; height: 10px; background-color: {{$dato["color"]}};"></div>
                </td>
                <td>
                    <td><img src="{{asset("assets/img/".$dato['id'].".png")}}" loading="lazy" alt="{{$dato["nombre"]}}" class="img-sm"></td>
                </td>
                <td>
                    <p style="margin: 0;">{{$dato["nombre"]}}</p>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>
